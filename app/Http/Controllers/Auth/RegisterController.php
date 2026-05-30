<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegistrationService;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request, RegistrationService $service): RedirectResponse
    {
        $service->register($request->validated());

        auth()->login(User::where('login', $request->login)->first());

        return redirect('/verify')->with('success', 'Регистрация прошла успешно! Пожалуйста, проверьте свои уведомления для получения кода подтверждения.');
    }

    public function form()
    {
        return view('auth.register');
    }
}
