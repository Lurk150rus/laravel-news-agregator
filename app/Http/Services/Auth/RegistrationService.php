<?php

declare(strict_types=1);

namespace App\Http\Services\Auth;

use App\Models\User;
use App\Models\VerificationCode;

final class RegistrationService
{
    public function register(array $data): User
    {
        $user = User::create([
            'login' => $data['login'],
            'password' => $data['password'],
        ]);

        $this->createVerficationCode($user);

        return $user;
    }

    private function createVerficationCode(User $user): VerificationCode
    {
        return $user->verificationCodes()->create([
            'code' => $this->generateCode(),
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);
    }

    private function generateCode(): string
    {
        return (string) random_int(100000, 999999);
    }
}
