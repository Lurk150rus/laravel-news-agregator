<?php

declare(strict_types=1);

namespace App\Http\Services\Auth;

use App\Models\User;
use App\Models\VerificationCode;
use App\Services\Auth\VerificationCodeGenerator;
use Illuminate\Support\Facades\Hash;

final class RegistrationService
{
    public function __construct(
        private VerificationCodeGenerator $codeGenerator
    ) {}
    public function register(array $data): User
    {
        $user = User::create([
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
        ]);

        $this->createVerificationCode($user);

        return $user;
    }

    private function createVerificationCode(User $user): VerificationCode
    {
        return $user->verificationCodes()->create([
            'code' => $this->codeGenerator->generate(),
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);
    }

}
