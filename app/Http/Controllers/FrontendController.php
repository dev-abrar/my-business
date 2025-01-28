<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{
    function index()
    {
        $products = Product::latest()->take(20)->get();
        if (Auth::guard('teacherlogin')->check()) {
            return redirect()->route('teacher.dashboard');
        }
        if (Auth::guard('studentlogin')->check()) {
            return redirect()->route('student.dashboard');
        }
        return view('pages.frontend.index', compact('products'));
    }

    function frontend_login()
    {
        if (Auth::guard('teacherlogin')->check()) {
            return redirect()->route('teacher.dashboard');
        }
        if (Auth::guard('studentlogin')->check()) {
            return redirect()->route('student.dashboard');
        }
        return view('pages.frontend.login');
    }

    function frontend_login_post(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($request->role == 1) {
            if (Auth::guard('teacherlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/teacher-dashboard');
            } else {
                return back()->withError("The Credential Does not match with records!");
            }
        } elseif ($request->role == 2){
            if (Auth::guard('studentlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('student.dashboard');
            } else {
                // return back()->withErrors(["The credentials do not match our records for students."]);
                return back()->withError("The credentials do not match our records for students.");

            }
        }
    }

    // student work
    function my_order()
    {
        
        $myorders = Order::where('student_id', Auth::guard('studentlogin')->id())->latest()->paginate(20);
        return view('pages.frontend.student.my_order', [
            'myorders'=>$myorders,
        ]);
    }

    function mobile_recharge(){
        return view('pages.frontend.student.mobile_recharge');
    }

    function product(Request $request){
        $categories = Category::all();
        $products = Product::latest()->paginate(28);
        if ($request->ajax()) {
            return view('pages.frontend.partial.product_list', compact('products'))->render();
        }
        return view('pages.frontend.student.resel_product', compact('categories', 'products'));
    }

    function single_product($slug){
        $product_info = Product::where('slug', $slug)->first();
        $galleries = ProductGallery::where('product_id', $product_info->id)->get();
        return view('pages.frontend.student.single_product', compact('product_info', 'galleries'));
    }

    function checkout($slug){
        $product_info = Product::where('slug', $slug)->first();
        return view('pages.frontend.student.checkout', compact('product_info'));
    }
    
    function microjob(){
        $jobs = Job::latest()->paginate(20);
        return view('pages.frontend.student.micro_jobs', compact('jobs'));
    }

    function single_job($id){
        $job_info = Job::find($id);
        return view('pages.frontend.student.single_job', compact('job_info'));
    }

    function view_ads(){
        return view('pages.frontend.student.view_ads');
    }

    function salary(){
        return view('pages.frontend.student.month_salary');
    }
    function our_course(){
        return view('pages.frontend.student.ourt_course');
    }

    function omrah(){
        return view('pages.frontend.student.omrah');
    }

    function quran(){
        return view('pages.frontend.student.quran');
    }

    function bandle_offer(){
        return view('pages.frontend.student.drive_offer');
    }
    
    
}
