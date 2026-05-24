<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendVerificationCodeRequest;
use App\Services\Auth\ResendVerificationCodeService;

class ResendVerificationCodeController extends Controller
{
    public function resend(ResendVerificationCodeRequest $request, ResendVerificationCodeService $service)
    {

        $service->resend($request->validated());

        return back()->with('status', 'Code sent');
    }
}
