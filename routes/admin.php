<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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
        Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

    });

});