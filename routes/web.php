<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectRegistrationController;
use App\Http\Controllers\ResultCheckerController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UploadResultController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/go-back', function () {
    return redirect()->back();
})->name('go-back');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix("admin")->middleware(['auth','verified'])->group(function() {
    Route::prefix("teachers")->group(function() {
        Route::get("/", [TeacherController::class, 'index'])->name('admin-teacher');
        Route::get("/add", [TeacherController::class, 'create'])->name('admin-teacher-add');
        Route::post("/add", [TeacherController::class, 'store'])->name('admin-teacher-store');
        Route::get("/edit", [TeacherController::class, 'edit'])->name('admin-teacher-edit');
        Route::post("/update", [TeacherController::class, 'update'])->name('admin-teacher-update');
        Route::get("/subject", [TeacherController::class, 'subject'])->name('admin-teacher-subject');
        Route::post("/add-subject", [TeacherController::class, 'store_subject'])->name('admin-teacher-subject-store');
        Route::post("/delete-subject", [TeacherController::class, 'destroy_subject'])->name('admin-teacher-subject-destroy');
    });

    Route::prefix("students")->group(function() {
        Route::get("/", [StudentController::class, 'index'])->name('admin-student');
        Route::get("/add", [StudentController::class, 'create'])->name('admin-student-add');
        Route::post("/add", [StudentController::class, 'store'])->name('admin-student-store');
        Route::get("/edit", [StudentController::class, 'edit'])->name('admin-student-edit');
        Route::post("/update", [StudentController::class, 'update'])->name('admin-student-update');
        Route::post("/store", [StudentController::class, 'store'])->name('admin-student-store');
        Route::get("/students", [StudentController::class, 'list'])->name('admin-student-get');
        Route::post("/student-status", [StudentController::class, 'change_status'])->name('admin-student-status');
    });
});


Route::prefix("result-checker")->middleware(['auth','verified'])->group(function() {
    Route::get("/", [ResultCheckerController::class, 'index'])->name("result-checker");
    Route::get("/check-result", [ResultCheckerController::class, 'check_result'])->name("check-result");
});

//Teacher Upload
Route::prefix("upload")->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [UploadResultController::class, 'index'])->name("upload-index");
    Route::get('/class', [UploadResultController::class, 'class_index'])->name("upload-index-class");
    Route::get('query/subject', [UploadResultController::class, 'query'])->name("upload-query");
    Route::get('query/class', [UploadResultController::class, 'class_query'])->name("upload-query-class");
    Route::post('query', [UploadResultController::class, 'queryUpload'])->name("upload-query-post");
});

require __DIR__.'/auth.php';
