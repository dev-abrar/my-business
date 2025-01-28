<?php

namespace App\Http\Controllers;

use App\Models\FrontendNotify;
use App\Models\MobileRecharge;
use App\Models\Notification;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentVarify;
use App\Models\StudentWallet;
use App\Models\Teacher;
use App\Models\TeacherAccount;
use App\Models\TeacherWallet;
use App\Models\WebContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class StudentController extends Controller
{
    function users()
    {
        $teachers = Teacher::all();
        return view('pages.dashboard.students', compact('teachers'));
    }
    function user_list()
    {
        $users = Student::with('teacher')->latest()->get()->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'number' => $student->number,
                'teacher_id' => $student->teacher_id,
                'teacher_name' => $student->teacher ? $student->teacher->name : 'NULL',
                'sts' => $student->sts,
            ];
        });

        return response()->json($users);
    }

    function studentOfTeacher_create(Request $request)
    {
        Student::find($request->user_id)->update([
            'teacher_id' => $request->teacher_id,
        ]);
        return response()->json();
    }

    // card status
    public function student_status(Request $request)
    {
        $product = Student::find($request->user_id);

        if ($request->has('sts')) {
            $product->update([
                'sts' => $request->sts,
            ]);
        }

        return response()->json(['success' => 'Student status updated successfully']);
    }

    function user_delete(Request $request)
    {
        $present = Student::find($request->user_id);
        if ($present->photo != null) {
            unlink(public_path('upload/student/' . $present->photo));
        }
        Student::find($request->user_id)->delete();
        return response()->json([
            'status' => 'success',
        ], status: 201);
    }

    // students frontend work
    function student_dashboard()
    {
        return view('pages.frontend.student.student_dashboard');
    }

    function student_profile()
    {
        return view('pages.frontend.student.student_profile');
    }

    function student_profile_update(Request $request)
    {

        $profile = Student::find(Auth::guard('studentlogin')->id());

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
                unlink(public_path('upload/student/' . $profile->photo));
            }

            $img = $request->file('photo');
            $fileName = $profile->id . '.' . $img->getClientOriginalExtension();
            $preview_path = public_path('upload/student/' . $fileName);
            Image::make($img)->resize(500, 500)
                ->save($preview_path, 80);

            $profile->update([
                'photo' => $fileName,
            ]);
        }

        return response()->json();
    }

    function student_create(Request $request)
    {

        $refer_code = random_int(10000000, 99999999);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'refer_code' => $refer_code,
            'refer_by' => Auth::guard('studentlogin')->user()->refer_code,
            'password' => Hash::make($request->password),
        ]);
        return response()->json();
    }

    function student_varify(Request $request)
    {
        $web_content = WebContent::where('id', 1)->first();

        if ($request->payment_method == 'bkash') {
            $number = $web_content->bkash;
        } elseif ($request->payment_method == 'nagad') {
            $number = $web_content->nagad;
        } elseif ($request->payment_method == 'rocket') {
            $number = $$web_content->rocket;
        }

        StudentVarify::create([
            'student_id' => $request->student_id,
            'payment_method' => $request->payment_method,
            'number' => $number,
            'amount' => $request->amount,
            'transaction' => $request->transaction,
            'account_number' => $request->account_number,
        ]);

        $this->processReferral($request->student_id);

        return response()->json();
    }
    //  refaral work 
    public function processReferral($studentId)
    {
        $amounts = [40, 10, 7, 5];

        $student = Student::find($studentId);
        $referBy = $student->refer_by;

        // Handle teacher wallet
        if ($referBy) {
            $referredStudent = Student::where('refer_code', $referBy)->first();
            if ($referredStudent && $referredStudent->teacher_id) {
                $teacherWallet = TeacherWallet::firstOrCreate(
                    ['teacher_id' => $referredStudent->teacher_id],
                    ['total' => 0, 'available' => 0, 'withraw' => 0]
                );

                // Increase the teacher's wallet balance
                $teacherWallet->increment('total', 30);
                $teacherWallet->increment('available', 30);

                // Log the teacher account entry
                TeacherAccount::create([
                    'teacher_id' => $referredStudent->teacher_id,
                    'work' => 'By Student',
                    'amount' => 30.00,
                ]);
            }
        }

        $level = 0;
        while ($referBy && $level < 4) {
            $referredStudent = Student::where('refer_code', $referBy)->first();

            if ($referredStudent) {
                // Handle student wallet
                $studentWallet = StudentWallet::firstOrCreate(
                    ['student_id' => $referredStudent->id],
                    ['total' => 0, 'available' => 0, 'withraw' => 0]
                );

                // Increase the student's wallet balance
                $studentWallet->increment('total', $amounts[$level]);
                $studentWallet->increment('available', $amounts[$level]);

                // Log the student account entry
                StudentAccount::create([
                    'student_id' => $referredStudent->id,
                    'work' => 'Sign Up',
                    'amount' => $amounts[$level],
                ]);
            }

            $referBy = $referredStudent->refer_by;
            $level++;
        }
    }



    function student_logout()
    {
        Auth::guard('studentlogin')->logout();
        return redirect('/frontend-login');
    }

    function student_refered()
    {
        $students = Student::where('refer_by', Auth::guard('studentlogin')->user()->refer_code)->latest()->paginate(50);
        $total_student = Student::where('refer_by', Auth::guard('studentlogin')->user()->refer_code)->count();
        $active = $students->where('sts', 1)->count();
        return view('pages.frontend.student.refered_student', compact('students', 'active', 'total_student'));
    }

    function student_pass_book()
    {
        $pass_book = StudentAccount::where('student_id', Auth::guard('studentlogin')->id())->latest()->paginate(20);
        return view('pages.frontend.student.student_pass_book', compact('pass_book'));
    }

    public function student_balance()
    {
        $studentId = Auth::guard('studentlogin')->id();

        // Fetch wallet data and check if it exists
        $wallet = StudentWallet::where('student_id', $studentId)->first();

        if (!$wallet) {
            // If no wallet exists, set default values
            $availableBalance = 0;
            $totalWithdrawn = 0;
        } else {
            $availableBalance = $wallet->available;
            $totalWithdrawn = $wallet->withraw;
        }

        // Fetch the total balance from the student's accounts
        $totalBalance = StudentAccount::where('student_id', $studentId)->sum('amount');

        return view('pages.frontend.student.student_balance', compact('totalBalance', 'availableBalance', 'totalWithdrawn'));
    }

    public function withdrawBalance(Request $request)
    {
        $student = Auth::guard('studentlogin')->user(); // Get the authenticated student

        // Validate request data
        $validated = $request->validate([
            'amount' => 'required|numeric|min:100',
            'method' => 'required|string|max:50',
            'number' => 'required',
            'password' => 'required',
        ]);

        // Get the student's wallet
        $wallet = StudentWallet::where('student_id', $student->id)->first();

        if (!$wallet) {
            return response()->json(['errors' => ['wallet' => 'Wallet not found.']], 404);
        }

        // Check if the requested amount is more than the available balance
        if ($request->amount > $wallet->available) {
            return response()->json(['errors' => ['amount' => 'You do not have enough funds available for this withdrawal.']], 422);
        }

        // Check if the password matches the stored password
        if (!Hash::check($request->password, $student->password)) {
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
                'student_id' => $student->id,
                'teacher_id' => null,
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

    function student_nitification($id)
    {
        $notify = FrontendNotify::find($id);
        $notify->update([
            'sts' => 2,
        ]);
        return view('pages.frontend.student.student_notification', compact('notify'));
    }

    public function recharge(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'number' => 'required|string',
            'amount' => 'required|numeric|min:20',
            'operator' => 'required|integer', // Adjusted to match the database
            'type' => 'required|integer', // Adjusted to match the database
            'password' => 'required|string',
        ]);

        // Get the authenticated student
        $student = Auth::guard('studentlogin')->user();

        // Check if the entered password matches the stored password
        if (!Hash::check($request->password, $student->password)) {
            return response()->json(['error' => 'Password does not match!'], 422);
        }

        // Check if the available balance is sufficient
        $wallet = StudentWallet::where('student_id', $student->id)->first();
        if ($wallet && $wallet->available < $request->amount) {
            return response()->json(['error' => 'Insufficient balance!'], 422);
        }

        // Begin the transaction
        DB::beginTransaction();

        try {
            // Deduct the recharge amount from the available balance
            $wallet->available -= $request->amount;
            $wallet->withraw += $request->amount;
            $wallet->save();

            // Insert the recharge record into mobile_recharges table
            MobileRecharge::create([
                'name' => $request->name,
                'number' => $request->number,
                'amount' => $request->amount,
                'operator' => $request->operator,
                'type' => $request->type,
            ]);

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json(['success' => 'Your phone will be recharged within 1 hour!']);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Log the error for debugging
            Log::error($e->getMessage());

            return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }
    }

}
