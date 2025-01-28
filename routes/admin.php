<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebContentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

    // users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'users'])->name('users');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/list', [UserController::class, 'user_list'])->name('user.list');
        Route::post('/create', [UserController::class, 'user_create'])->name('user.create');
        Route::post('/delete', [UserController::class, 'user_delete'])->name('user.delete');
        Route::post('/update', [UserController::class, 'profile_update'])->name('profile.update');
        Route::post('/photo', [UserController::class, 'profile_photo'])->name('profile.photo');
    });

    // teachers
    Route::group(['prefix' => 'teachers'], function () {
        Route::get('/', [TeacherController::class, 'users'])->name('teachers');
        Route::get('/list', [TeacherController::class, 'user_list'])->name('teacher.list');
        Route::post('/create', [TeacherController::class, 'user_create'])->name('teacher.create');
        Route::post('/delete', [TeacherController::class, 'user_delete'])->name('teacher.delete');
        Route::post('/student-teacher-delete', [TeacherController::class, 'student_teacher_delete'])->name('student.teacher.delete');
        Route::get('/studentUnderTeacher', [TeacherController::class, 'studentUnderTeacher'])->name('studentUnderTeacher');
    });

    // teachers
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentController::class, 'users'])->name('students');
        Route::get('/list', [StudentController::class, 'user_list'])->name('student.list');
        Route::post('/delete', [StudentController::class, 'user_delete'])->name('student.delete');
        Route::post('/student-status', [StudentController::class, 'student_status'])->name('student.status');
        Route::post('/studentOfTeacher-create', [StudentController::class, 'studentOfTeacher_create'])->name('studentOfTeacher.create');
    });

    // teachers
    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('withraw');
        Route::get('/withraw-list', [NotificationController::class, 'list'])->name('withraw.list');
        Route::post('/withraw-sts', [NotificationController::class, 'withraw_sts'])->name('withraw.sts');

        Route::get('/recharge', [NotificationController::class, 'recharges'])->name('recharges');
        Route::get('/recharge-list', [NotificationController::class, 'recharge_list'])->name('recharge.list');
        Route::post('/recharge-sts', [NotificationController::class, 'recharge_sts'])->name('recharge.sts');

        Route::get('/varify', [NotificationController::class, 'varify'])->name('varify');
        Route::get('/varify-list', [NotificationController::class, 'varify_list'])->name('varify.list');
        Route::post('/varify-sts', [NotificationController::class, 'varify_sts'])->name('varify.sts');
    });

    Route::group(['prefix' => 'add/microjobs'], function () {
        Route::get('/', [JobController::class, 'index'])->name('add.microjob');
        Route::get('/list', [JobController::class, 'list'])->name('job.list');
        Route::post('/create', [JobController::class, 'create'])->name('job.create');
        Route::post('/delete', [JobController::class, 'delete'])->name('job.delete');
        Route::get('/proof', [JobController::class, 'job_proof'])->name('job.proof');
        Route::get('/proof/list', [JobController::class, 'proof_list'])->name('proof.list');
        Route::post('/proof/status', [JobController::class, 'proof_sts'])->name('proof.sts');
        Route::post('/proof/delete', [JobController::class, 'proof_delete'])->name('proof.delete');
        Route::get('/payment', [JobController::class, 'payment'])->name('payment');
        Route::post('/payment/student', [JobController::class, 'payment_student'])->name('payment.student');
        Route::post('/payment/teacher', [JobController::class, 'payment_teacher'])->name('payment.teacher');
    });

    // product
    Route::group(['prefix' => 'products'], function () {
        Route::get('/list', [ProductController::class, 'list'])->name('product.list');
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::get('/gallery/{product_id}', [ProductController::class, 'get_product_gallery'])->name('product.gallery');
        Route::post('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/delete', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('/update', [ProductController::class, 'update'])->name('product.update');
    });

    // categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::get('/list', [CategoryController::class, 'list'])->name('category.list');
        Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('category.delete');
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

    // categories
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'orders'])->name('orders');
        Route::get('/list', [OrderController::class, 'order_list'])->name('order.list');
        Route::post('/update', [OrderController::class, 'update'])->name('order.sts');
    });


    Route::get('/web-contents', [WebContentController::class, 'web_content'])->name('web.content');
    Route::post('/web-contents/update', [WebContentController::class, 'web_content_update'])->name('web.content.update');


    
    Route::post('/quiz/store', [QuizController::class, 'store'])->name('admin.quiz.store');
    Route::get('/view/quiz-list', [QuizController::class, 'viewQuiz'])->name('view.quiz.list');
    Route::put('/quiz/update', [QuizController::class, 'update'])->name('admin.quiz.update');
    Route::delete('/admin/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.delete');
    Route::get('/quiz/submission', [QuizController::class, 'submission'])->name('submission');
    Route::delete('/admin/submit/{id}', [QuizController::class, 'submit_destroy']);
});
