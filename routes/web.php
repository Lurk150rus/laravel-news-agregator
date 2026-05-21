<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\ResendVerificationCodeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/verify', [VerifyController::class
, 'store']);

Route::post('/resend-code', [ResendVerificationCodeController::class, 'resend']);
Route::post('/login', [LoginController::class, 'login']);
