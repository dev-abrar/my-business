<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobProof;
use App\Models\JobProofImage;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentWallet;
use App\Models\Teacher;
use App\Models\TeacherAccount;
use App\Models\TeacherWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class JobController extends Controller
{
    function index()
    {
        return view('pages.dashboard.job');
    }

    public function create(Request $request)
    {
        $request->validate([
            'desp' => 'required',
            'image' => 'nullable|image|max:2048',
        ], [
            'image.max' => 'Job Image must not be greater than 2mb',
        ]);

        // Create the banner without the image first
        $job = Job::create([
            'desp' => $request->desp,
            'amount' => $request->amount,
            'link' => $request->link,
        ]);

        // If image is uploaded, process it
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $fileName = $job->id . '.' . $img->getClientOriginalExtension();
            $preview_path = public_path('upload/job/' . $fileName);
            Image::make($img)->resize(600, 400)
                ->save($preview_path);


            // Update the banner with the image
            $job->update([
                'image' => $fileName,
            ]);
        }

        return response()->json([
            'message' => 'Job Created Successfully!',
            'data' => $job,
        ]);
    }

    function list()
    {
        return Job::all();
    }

    function delete(Request $request)
    {
        $present = Job::find($request->job_id);
        if ($present->image != null) {
            unlink(public_path('upload/job/' . $present->image));
        }
        $present->delete();
        return response()->json();
    }

    function job_proof()
    {
        return view('pages.dashboard.job_proof');
    }

    function proof_list()
    {
        return JobProof::with(['student', 'job', 'images'])->get();
    }
    function proof_sts(Request $request)
    {
        $Recharge = JobProof::find($request->proof_id);
        $Recharge->update([
            'sts' => $request->sts,
        ]);

        return response()->json();
    }

    public function proof_delete(Request $request)
    {
        $proofId = $request->proof_id;

        // Find the proof record
        $proof = JobProof::find($proofId);

        if (!$proof) {
            return response()->json([
                'status' => 'error',
                'message' => 'Proof not found.'
            ]);
        }

        // Retrieve all associated images
        $images = JobProofImage::where('proof_id', $proofId)->get();

        // Delete each image from the filesystem
        foreach ($images as $image) {
            $imagePath = public_path('upload/proof/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // Delete the image record from the `job_proof_images` table
            $image->delete();
        }

        // Delete the proof record
        $proof->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Proof and associated images deleted successfully.'
        ]);
    }

    function proof_store(Request $request)
    {
        $request->validate([
            'desp' => 'required',
            'images' => 'required|array|max:6',
            'images.*' => 'image|max:2048',
        ], [
            'images.required' => 'Please upload at least one image.',
            'images.array' => 'Images must be uploaded as an array.',
            'images.max' => 'You can upload a maximum of 6 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.max' => 'Each image must be less than 2 MB.',
        ]);

        $random = random_int(1000, 999999);

        // Insert the main proof record
        $jobProof = JobProof::create([
            'student_id' => $request->student_id,
            'job_id' => $request->job_id,
            'desp' => $request->desp,
        ]);

        // Handle and save each image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageExtension = $image->getClientOriginalExtension();
                $imageName = $jobProof->id . '_' . $random . '_' . $index . '.' . $imageExtension;

                $imagePath = public_path('upload/proof/' . $imageName);
                Image::make($image)->save($imagePath, 80); // Resize and save the image

                // Save image details in `job_proof_images` table
                JobProofImage::create([
                    'proof_id' => $jobProof->id,
                    'image' => $imageName,
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Proof submitted successfully!']);
    }


    // payment work
    function payment()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        return view('pages.dashboard.payment', [
            'students' => $students,
            'teachers' => $teachers,
        ]);
    }

    public function payment_student(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'student_id' => 'required|exists:students,id',
        ]);

        DB::beginTransaction();

        try {
            $studentId = $request->student_id;
            $amount = $request->amount;

            // 1. Create an entry in student_accounts
            StudentAccount::create([
                'student_id' => $studentId,
                'work' => $request->name,
                'amount' => $amount,
            ]);

            // 2. Check if a wallet already exists for the student
            $studentWallet = StudentWallet::firstOrCreate(
                ['student_id' => $studentId], // Conditions
                ['total' => 0, 'available' => 0] // Defaults if not found
            );

            // 3. Update the wallet's total and available balance
            $studentWallet->total += $amount;
            $studentWallet->available += $amount;
            $studentWallet->save();

            DB::commit();

            return response()->json([
                'message' => 'Student payment processed successfully!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function payment_teacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        DB::beginTransaction();

        try {
            $teacherId = $request->teacher_id;
            $amount = $request->amount;

            // 1. Create an entry in student_accounts
            TeacherAccount::create([
                'teacher_id' => $teacherId,
                'work' => $request->name,
                'amount' => $amount,
            ]);

            // 2. Check if a wallet already exists for the student
            $teacherWallet = TeacherWallet::firstOrCreate(
                ['teacher_id' => $teacherId], // Conditions
                ['total' => 0, 'available' => 0] // Defaults if not found
            );

            // 3. Update the wallet's total and available balance
            $teacherWallet->total += $amount;
            $teacherWallet->available += $amount;
            $teacherWallet->save();

            DB::commit();

            return response()->json([
                'message' => 'Teacher payment processed successfully!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
