<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyRequest;
use App\Services\Auth\VerificationService;
use App\Models\User;

class VerifyController extends Controller
{
    public function store(VerifyRequest $request, VerificationService $service)
    {
        $service->verify($request->validated());

        $user = User::firstWhere('login', $request->validated()['login']);

        auth()->login($user);

        return redirect('/news');
    }

    public function form()
    {
        return view('auth.verify');
    }
}
