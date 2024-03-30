<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/


Route::group(['prefix' => 'admin'], function () {

    // Auth routes
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/verify-login', [AuthController::class, 'verifyLogin'])->name('admin.verifyLogin');


    // Dashboard routes 

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::resource('/category', CategoryController::class);
        Route::post('/category/{id}/updatee', [CategoryController::class, 'update'])->name('category.updatee');
        Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admincategory.destroy');

        Route::resource('/adminjobs', JobsController::class);
        Route::post('/adminjobs/{id}/updatee', [JobsController::class, 'update'])->name('adminjobs.updatee');
        Route::get('/adminjobs/{id}/delete', [JobsController::class, 'destroy'])->name('adminjobs.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('admin.usersdestroy');







        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings/update/password', [SettingsController::class, 'updatePassword'])->name('admin.updatePassword');
    });

});