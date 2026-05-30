<?php

use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVerificationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\ResendVerificationCodeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\Admin;
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

Route::group(['middleware' => ['auth', Verified::class]], function () {
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
});

Route::prefix('admin')->middleware(['auth', Verified::class, Admin::class])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('verifications', [AdminVerificationController::class, 'index'])->name('admin.verifications.index');
    Route::get('news', [AdminNewsController::class, 'index'])->name('admin.news.index');
});
