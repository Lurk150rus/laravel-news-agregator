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
        return $service->verify($request->validated());
    }
}
