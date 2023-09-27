<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});



//Navbar-DropDown
Route::get('/', function () {
    return view('home.index');
});
Route::get('/recommend', function () {
    return view('home.recommend');
});
Route::get('/courses', function () {
    return view('home.courses');
});
Route::get('/college', function () {
    return view('home.college');
});
Route::get('/aboutus', function () {
    return view('home.aboutus');
});
Route::get('/contact', function () {
    return view('home.contact');
});
Route::get('/college-signup', function () {
    return view('home.collegeSignUP');
});




Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
        Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
        Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
        Route::get('settings',[AdminController::class,'settings'])->name('admin.settings');


        Route::post('update-profile-info',[AdminController::class,'updateInfo'])->name('adminUpdateInfo');
        Route::post('change-profile-picture',[AdminController::class,'updatePicture'])->name('adminPictureUpdate');
        Route::post('change-password',[AdminController::class,'changePassword'])->name('adminChangePassword');
       
});

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('settings',[UserController::class,'settings'])->name('user.settings');
    
});

Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/', function () {
    return view('home.index');
})->name('home');


Route::get('/college/create', [CollegeController::class, 'create'])->name('college.create');
Route::post('/college/store', [CollegeController::class, 'store'])->name('college.store');
Route::get('/college/show', [CollegeController::class, 'show'])->name('college.show');
Route::get('/college', function(){
    return view('home.collegeSignUP');
});

Route::get('/collegesignupshow', function(){
    return view('home.collegeSignUP');
});



//CourseDetail
Route::get('/coursedetail', function(){
    return view('home.coursedetail');
});
Route::get('/coursedetail/create', [CourseDetailController::class, 'create'])->name('coursedetail.create');
Route::post('/coursedetail/store', [CourseDetailController::class, 'store'])->name('coursedetail.store');
Route::get('/coursedetail/show', [CourseDetailController::class, 'show'])->name('coursedetail.show');
Route::get('/coursedetail/delete/{id}', [CourseDetailController::class, 'destroy'])->name('coursedetail.destroy');
Route::get('/coursedetail/edit/{id}',[CourseDetailController::class,'edit']);
Route::post('/coursedetail/update/{id}', [CourseDetailController::class, 'update'])->name('coursedetail.update');

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});


//college routing
Route::get('/collegedashboard', function(){
    return view('college.dashboard');
});
Route::get('/college/edit-profile', function(){
    return view('college.edit');
});
Route::get('/college/view-inquiry', function(){
    return view('college.inquiry');
});
Route::get('/college/view-student', function(){
    return view('college.student');
});
Route::get('/college/coursedetailshow', [CourseDetailController::class, 'show'])->name('coursedetail.show');

Route::get('/college/logout', function(){
    return view('college.logout');
});


Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/admin/contact/show', [ContactController::class, 'show'])->name('contact.show');
Route::get('/contact/update-status/{id}', [ContactController::class, 'updateStatus'])->name('contact.updateStatus');
Route::get('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');




