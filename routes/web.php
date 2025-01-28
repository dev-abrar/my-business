<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/frontend-login', [FrontendController::class, 'frontend_login'])->name('frontend.login');

// login post
Route::post('/frontend/login/post', [FrontendController::class, 'frontend_login_post'])->name('frontend.login.post');

// teachers
Route::group(['middleware' => 'teacherlogin'], function () {
    Route::get('/teacher-dashboard', [TeacherController::class, 'teacher_dashboard'])->name('teacher.dashboard');
    Route::get('/teacher-profile', [TeacherController::class, 'teacher_profile'])->name('teacher.profile');
    Route::post('/teacher-profile-update', [TeacherController::class, 'teacher_profile_update'])->name('teacher.profile.update');
    Route::get('/teacher-pass-book', [TeacherController::class, 'teacher_pass_book'])->name('teacher.pass.book');
    Route::get('/teacher-balance', [TeacherController::class, 'teacher_balance'])->name('teacher.balance');
    Route::post('/teacher-withraw', [TeacherController::class, 'teacher_withraw']);
    Route::get('/teacher-nitification/{id}', [TeacherController::class, 'teacher_nitification'])->name('teacher.nitification');
    Route::get('/teacher/logout', [TeacherController::class, 'teacher_logout'])->name('teacher.logout');
});

//student middleware
Route::group(['middleware' => 'studentlogin'], function () {
    // student personal
    Route::get('/student-dashboard', [StudentController::class, 'student_dashboard'])->name('student.dashboard');
    Route::get('/student-profile', [StudentController::class, 'student_profile'])->name('student.profile');
    Route::post('/student-profile-update', [StudentController::class, 'student_profile_update'])->name('student.profile.update');
    Route::post('/student-create', [StudentController::class, 'student_create']);
    Route::post('/student-varify', [StudentController::class, 'student_varify']);
    Route::get('/student-logout', [StudentController::class, 'student_logout'])->name('student.logout');

    Route::get('/student-refered', [StudentController::class, 'student_refered'])->name('student.refered');
    Route::get('/student-balance', [StudentController::class, 'student_balance'])->name('student.balance');
    Route::get('/student-pass-book', [StudentController::class, 'student_pass_book'])->name('student.pass.book');
    Route::post('/mobile-recharge', [StudentController::class, 'recharge']);
    Route::post('/student-withraw', [StudentController::class, 'withdrawBalance']);
    Route::get('/student-nitification/{id}', [StudentController::class, 'student_nitification'])->name('student.nitification');


    // student others
    Route::get('/my-order', [FrontendController::class, 'my_order'])->name('my.order');
    Route::get('/mobile-recharge', [FrontendController::class, 'mobile_recharge'])->name('mobile.recharge');
    Route::get('/view-ads', [FrontendController::class, 'view_ads'])->name('view.ads');
    Route::get('/monthly-salary', [FrontendController::class, 'salary'])->name('month.salary');
    Route::get('/our-course', [FrontendController::class, 'our_course'])->name('our.course');
    Route::get('/omrah', [FrontendController::class, 'omrah'])->name('omrah');
    Route::get('/quran', [FrontendController::class, 'quran'])->name('quran');
    Route::get('/drive-offer', [FrontendController::class, 'bandle_offer'])->name('bandle.offer');
    
    Route::get('/our-quize', [QuizController::class, 'showQuiz'])->name('our.quize');
    Route::post('/quiz/submit', [QuizController::class, 'submitAnswers'])->name('submit.answers');
    Route::get('/quiz/results', [QuizController::class, 'showResults'])->name('quiz.results');

    Route::get('/microjobs', [FrontendController::class, 'microjob'])->name('microjob');
    Route::get('/single-job/{id}', [FrontendController::class, 'single_job'])->name('single.job');
    Route::post('/job-proofs/store', [JobController::class, 'proof_store']);



});



Route::get('/reselling', [FrontendController::class, 'product'])->name('resell.product');
Route::get('/single-product/{slug}', [FrontendController::class, 'single_product'])->name('single.product');
Route::get('/checkout/{slug}', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/checkout-order', [OrderController::class, 'checkout_order'])->name('checkout.order');
Route::get('/order/success/{order_id}', [OrderController::class, 'order_success'])->name('order.success');





// Route group for authenticated users
