<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VerificationService
{
    /**
     * Максимальное количество попыток ввода кода для одного пользователя.
     * @var int
     */
    const MAX_ATTEMPTS = 5;

    public function verify(array $data)
    {
        $user = auth()->user();

        if ($user?->is_verified) {
            throw ValidationException::withMessages(['code' => 'User already verified']);
        };

        $verification = $user->verificationCodes()
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (! $verification instanceof \App\Models\VerificationCode) {
            throw ValidationException::withMessages(['code' => 'Invalid or expired verification code']);
        };

        if ($verification->attempts >= self::MAX_ATTEMPTS) {
            throw ValidationException::withMessages(['code' => 'Too many failed verification attempts']);
        }

        if ($verification->code !== $data['code']) {
            $verification->attempts++;
            $verification->save();
            throw ValidationException::withMessages(['code' => 'Invalid verification code']);
        }

        DB::transaction(function () use ($verification, $user) {
            $verification->update([
                'verified_at' => now(),
            ]);

            $user->update([
                'is_verified' => true,
            ]);
        });
    }
}
