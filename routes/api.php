<?php

use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'verifyLogin']);
Route::post('verifyLoginOtp', [LoginController::class, 'verifyLoginOtp']);
Route::get('profile', [LoginController::class, 'userProfile']);
