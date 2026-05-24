<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\ResendVerificationCodeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\Verified;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'form']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/verify', [
    VerifyController::class,
    'store'
]);

Route::post('/resend-code', [ResendVerificationCodeController::class, 'resend']);

Route::get('/login', [LoginController::class, 'form']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => [Verified::class]], function () {
    Route::get('/news', [NewsController::class, 'index']);
});
