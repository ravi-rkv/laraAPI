<?php

use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

// Route::post('login', [LoginController::class, 'verifyLogin']);
// Route::post('verifyLoginOtp', [LoginController::class, 'verifyLoginOtp']);

//used to login user
Route::post('login', [LoginController::class, 'login']);
//if 2fa enabled then this will be called
Route::post('verifyLoginOtp', [LoginController::class, 'verifyLogin']);

Route::get('profile', [LoginController::class, 'userProfile']);
