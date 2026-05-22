<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginService $service)
    {
        return $service->login($request->validated());
    }
}
