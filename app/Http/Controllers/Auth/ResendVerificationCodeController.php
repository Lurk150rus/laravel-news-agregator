<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendVerificationCodeRequest;
use App\Http\Services\Auth\ResendVerificationCodeService;
use Illuminate\Http\Request;

class ResendVerificationCodeController extends Controller
{
    public function resend(ResendVerificationCodeRequest $request, ResendVerificationCodeService $service)
    {

        return $service->resend($request->validated());

    }
}
