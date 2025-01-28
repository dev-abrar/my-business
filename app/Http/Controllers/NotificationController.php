<?php

namespace App\Http\Controllers;

use App\Models\FrontendNotify;
use App\Models\MobileRecharge;
use App\Models\StudentVarify;
use App\Models\WithrawRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function index()
    {
        return view('pages.dashboard.withraw');
    }


    public function list()
    {
        // Eager load the teacher and student relationships
        $withrawRequests = WithrawRequest::with(['rel_to_teacher', 'rel_to_student'])->get();

        // Transform the data to include only the needed information
        $data = $withrawRequests->map(function ($request) {
            // Determine the user type and fetch the relevant name
            $user_type = null;
            $user_name = null;
            $user_id = null; // Initialize user_id

            if ($request->student_id) {
                $user_type = "Student";
                $user_name = $request->rel_to_student ? $request->rel_to_student->name : "Unknown";
                $user_id = $request->student_id; // Set student_id as user_id
            } elseif ($request->teacher_id) {
                $user_type = "Teacher";
                $user_name = $request->rel_to_teacher ? $request->rel_to_teacher->name : "Unknown";
                $user_id = $request->teacher_id; // Set teacher_id as user_id
            } else {
                $user_type = "Unknown";
                $user_name = "Unknown";
                $user_id = null; // No user_id if neither is present
            }

            return [
                'id' => $request->id,
                'user_type' => $user_type,
                'user_name' => $user_name,
                'amount' => $request->amount,
                'method' => $request->method,
                'sts' => $request->sts,
                'number' => $request->number,
                'user_id' => $user_id, // Include user_id
                'created_at' => $request->created_at,
            ];
        });

        // Return the transformed data as JSON
        return response()->json($data);
    }

    function withraw_sts(Request $request)
    {
        // Find the withdrawal request and update the status
        $withrawRequest = WithrawRequest::find($request->withraw_id);
        $withrawRequest->update([
            'sts' => $request->sts,
        ]);

        // Determine the user to notify
        $user_id = $request->user_id;
        $title = 'Your withdrawal is successful';

        // Check if the student_id is not null and match user_id with student_id
        if ($withrawRequest->student_id && $withrawRequest->student_id == $user_id) {

            FrontendNotify::create([
                'student_id' => $user_id,
                'title' => $title,
            ]);
        } elseif ($withrawRequest->teacher_id && $withrawRequest->teacher_id == $user_id) {
            // Create a notification for the teacher
            FrontendNotify::create([
                'teacher_id' => $user_id,
                'title' => $title,
            ]);
        }

        // Return a success response
        return response()->json();
    }

    // recharge 
    function recharges(){
        return view('pages.dashboard.recharge');
    }

    function recharge_list(){
        return MobileRecharge::all();
    }

    function recharge_sts(Request $request){
        $Recharge = MobileRecharge::find($request->recharge_id);
        $Recharge->update([
            'sts' => $request->sts,
        ]);

        return response()->json();
    }

    
    // recharge 
    function varify(){
        return view('pages.dashboard.varification');
    }

    function varify_list(){
        return StudentVarify::with('rel_to_student')->get();
    }

    function varify_sts(Request $request){
        $Recharge = StudentVarify::find($request->varify_id);
        $Recharge->update([
            'sts' => $request->sts,
        ]);

        return response()->json();
    }

}
