<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectRegistrationController;
use App\Http\Controllers\ResultCheckerController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UploadResultController;
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
    });
});

Route::prefix('bills')->middleware(['auth', 'verified'])->group(function() {
    Route::get("/", [BillsController::class, 'index'])->name('bills');
    Route::get("/select-bill", [BillsController::class, 'view_invoice'])->name('select-bill');
    Route::get("/make-payment-options", [BillsController::class, 'make_payment_options'])->name('make-payment-options');
    Route::get('/callback', [BillsController::class, 'callback'])->name('callback');
});

Route::prefix("result-checker")->middleware(['auth','verified'])->group(function() {
    Route::get("/", [ResultCheckerController::class, 'index'])->name("result-checker");
    Route::get("/check-result", [ResultCheckerController::class, 'check_result'])->name("check-result");
});

//Teacher Upload
Route::prefix("upload")->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [UploadResultController::class, 'index'])->name("upload-index");
    Route::get('query', [UploadResultController::class, 'query'])->name("upload-query");
    Route::post('query', [UploadResultController::class, 'queryUpload'])->name("upload-query-post");
});

require __DIR__.'/auth.php';
