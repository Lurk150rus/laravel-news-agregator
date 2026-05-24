<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginService $service)
    {
        $service->login($request->validated());

        return auth()?->user()->is_verified ? redirect('/news') : redirect()->route('verify');
    }

    public function form()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
