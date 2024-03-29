<?php

use App\Http\Controllers\Admin\AuthController;
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
    Route::get('/verify-login', [AuthController::class, 'verifyLogin'])->name('admin.verifyLogin');
});