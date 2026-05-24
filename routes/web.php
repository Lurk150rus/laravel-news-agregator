<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\ResendVerificationCodeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\Verified;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'form'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/verify', [VerifyController::class, 'form'])->name('verify');
Route::post('/verify', [
    VerifyController::class,
    'store'
]);

Route::post('/resend-code', [ResendVerificationCodeController::class, 'resend']);

Route::get('/login', [LoginController::class, 'form'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => [Verified::class]], function () {
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
});
