<?php

namespace App\Http\Controllers;

use App\Models\FrontendNotify;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherAccount;
use App\Models\TeacherWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravolt\Avatar\Facade as Avatar;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    function users()
    {
        return view('pages.dashboard.teachers');
    }
    function user_list()
    {
        $users = Teacher::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'number' => $user->number,
                    'photo' => $user->photo
                        ? asset('upload/teacher/' . $user->photo)
                        : Avatar::create($user->name)->toBase64(),
                ];
            });

        return response()->json($users);
    }

    function user_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'number' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'number.required' => 'Number is required',
            'password.required' => 'Password is required',
        ]);

        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Teacher Created Successfull!'
        ], status: 201);
    }

    function user_delete(Request $request)
    {
        $present = Teacher::find($request->user_id);
        if ($present->photo != null) {
            unlink(public_path('upload/teacher/' . $present->photo));
        }
        Teacher::find($request->user_id)->delete();
        return response()->json([
            'status' => 'success',
        ], status: 201);
    }

    function studentUnderTeacher(Request $request)
    {
        $teachers = Teacher::find($request->user_id);
        $students = Student::where('teacher_id', $teachers->id)->get();
        return view('pages.dashboard.studentOfTeacher', compact('teachers', 'students'));
    }

    function student_teacher_delete(Request $request)
    {
        Student::find($request->user_id)->update([
            'teacher_id' => null,
        ]);
        return response()->json();
    }

    // teacher frontend work
    function teacher_dashboard()
    {
        $students = Student::where('teacher_id', Auth::guard('teacherlogin')->id())->paginate(50);
        $total_students = Student::where('teacher_id', Auth::guard('teacherlogin')->id())->count();
        return view('pages.frontend.teacher.teacherDashboard', compact('students', 'total_students'));
    }

    function teacher_profile()
    {
        return view('pages.frontend.teacher.teacher_profile');
    }

    function teacher_profile_update(Request $request)
    {

        $profile = Teacher::find(Auth::guard('teacherlogin')->id());

        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
        ]);

        if ($request->password != '') {
            $profile->update([
                'password' => bcrypt($request->password),
            ]);
        }

        if ($request->hasFile('photo')) {

            if ($profile->photo != null) {
                unlink(public_path('upload/teacher/' . $profile->photo));
            }

            $img = $request->file('photo');
            $fileName = $profile->id . '.' . $img->getClientOriginalExtension();
            $preview_path = public_path('upload/teacher/' . $fileName);
            Image::make($img)->resize(500, 500)
                ->save($preview_path, 80);

            $profile->update([
                'photo' => $fileName,
            ]);
        }

        return response()->json();
    }

    function teacher_pass_book()
    {
        $pass_book = TeacherAccount::where('teacher_id', Auth::guard('teacherlogin')->id())->latest()->paginate(20);
        return view('pages.frontend.teacher.teacher_pass_book', compact('pass_book'));
    }

    function teacher_balance()
    {
        $teacherId = Auth::guard('teacherlogin')->id();

        // Fetch wallet data and check if it exists
        $wallet = TeacherWallet::where('teacher_id', $teacherId)->first();

        if (!$wallet) {
            // If no wallet exists, set default values
            $availableBalance = 0;
            $totalWithdrawn = 0;
        } else {
            $availableBalance = $wallet->available;
            $totalWithdrawn = $wallet->withraw;
        }

        // Fetch the total balance from the student's accounts
        $totalBalance = TeacherAccount::where('teacher_id', $teacherId)->sum('amount');

        return view('pages.frontend.teacher.teacher_balance', compact('totalBalance', 'availableBalance', 'totalWithdrawn'));
    }

    public function teacher_withraw(Request $request)
    {
        $teacher = Auth::guard('teacherlogin')->user(); // Get the authenticated student

        // Validate request data
        $validated = $request->validate([
            'amount' => 'required|numeric|min:100',
            'method' => 'required|string|max:50',
            'number' => 'required',
            'password' => 'required',
        ]);

        // Get the student's wallet
        $wallet = TeacherWallet::where('teacher_id', $teacher->id)->first();

        if (!$wallet) {
            return response()->json(['errors' => ['wallet' => 'Wallet not found.']], 404);
        }

        // Check if the requested amount is more than the available balance
        if ($request->amount > $wallet->available) {
            return response()->json(['errors' => ['amount' => 'You do not have enough funds available for this withdrawal.']], 422);
        }

        // Check if the password matches the stored password
        if (!Hash::check($request->password, $teacher->password)) {
            return response()->json(['errors' => ['password' => 'Incorrect password.']], 422);
        }

        // Proceed with the withdrawal
        DB::beginTransaction();

        try {
            // Decrease available balance
            $wallet->available -= $request->amount;
            // Increase withdrawn amount
            $wallet->withraw += $request->amount;

            // Save wallet changes
            $wallet->save();

            DB::table('withraw_requests')->insert([
                'teacher_id' => $teacher->id,
                'student_id' => null,
                'amount' => $request->amount,
                'method' => $request->method,
                'number' => $request->number,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => 'Your withdrawal has been processed. You will receive the funds within 1 hour.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal Error: ' . $e->getMessage()); // Log error for debugging
            return response()->json(['error' => 'An error occurred while processing the withdrawal. Please try again later.'], 500);
        }
    }

    function teacher_nitification($id)
    {
        $notify = FrontendNotify::find($id);
        $notify->update([
            'sts' => 2,
        ]);
        return view('pages.frontend.teacher.teacher_notification', compact('notify'));
    }

    function teacher_logout()
    {
        Auth::guard('teacherlogin')->logout();
        return redirect('/frontend-login');
    }
}
