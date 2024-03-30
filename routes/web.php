<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\JobsController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\JobApplicationController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/job-details/{id}', [HomeController::class, 'show'])->name('viewJob');
Route::get('/find-jobs', [HomeController::class, 'jobs'])->name('jobs.find');
Route::post('/get-jobs', [HomeController::class, 'getJobs'])->name('jobs.get');

Route::get('/pages/{title}', [HomeController::class, 'pages'])->name('pages.view');

Route::group(['middleware' => 'guest'], function () { 
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/verify/login', [AuthController::class, 'verifyLogin'])->name('login.verify');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register/store', [AuthController::class, 'storeRegister'])->name('register.store');
    
    Route::get('/recover-password', [AuthController::class, 'forget'])->name('forget');
    Route::post('/sent-recovery-mail', [AuthController::class, 'sentRecoveryMail'])->name('forget.sentRecoveryMail');
    Route::get('/reset-password/{hash}', [AuthController::class, 'resetHash'])->name('password.hash');
    Route::post('/reset-password/{hash}', [AuthController::class, 'resetPassword'])->name('password.reset');

});



Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile-update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::post('/profile-update-image', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');

    Route::get('/my-jobs', [JobsController::class, 'jobLists'])->name('jobs.index');    
    Route::get('/applied-jobs/{id?}', [ProfileController::class, 'appliedJobs'])->name('jobs.applied');
    Route::get('/saved-jobs/{id?}', [ProfileController::class, 'savedJobs'])->name('jobs.saved');

    Route::get('/post-new-job', [JobsController::class, 'createJob'])->name('createJob');
    Route::post('/post-new-job', [JobsController::class, 'storeJob'])->name('storeJob');
    Route::get('/edit-job/{id}', [JobsController::class, 'editJob'])->name('editJob');
    Route::post('/update-job/{id}', [JobsController::class, 'updateJob'])->name('updateJob');
    Route::get('/delete-job/{id}', [JobsController::class, 'deleteJob'])->name('deleteJob');


    Route::post('/apply-job/{id}', [JobApplicationController::class, 'applyJob'])->name('jobs.apply');
    Route::get('/apply-job/{id}/delete', [JobApplicationController::class, 'deleteApplyJob'])->name('jobs.apply.delete');
    Route::get('/save-job/{id}', [JobApplicationController::class, 'saveJob'])->name('jobs.save');
    Route::get('/saved-job/{id}/delete', [JobApplicationController::class, 'deleteSavedJob'])->name('jobs.saved.delete');

    
    
});