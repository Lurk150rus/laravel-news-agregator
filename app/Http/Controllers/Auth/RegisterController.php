<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\Auth\RegistrationService;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request, RegistrationService $service):User
    {
        return $service->register($request->validated());
    }
}
