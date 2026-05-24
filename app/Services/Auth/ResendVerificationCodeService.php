<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Services\Auth\VerificationCodeGenerator;
use Illuminate\Validation\ValidationException;

class ResendVerificationCodeService
{
    private const COOLDOWN_SECONDS = 60;

    public function __construct(
        private VerificationCodeGenerator $codeGenerator
    ) {}
    public function resend(array $data): void
    {

        $user = \App\Models\User::where('login', $data['login'])->first();

        if (! $user ) {
            throw ValidationException::withMessages([
                'login' => 'User not found',
            ]);
        }

        if ($user->is_verified) {
            throw ValidationException::withMessages([
                'login' => 'User already verified',
            ]);
        }

        $lastCode = $user->verificationCodes()->latest()->first();

        if ($lastCode && $lastCode->sent_at->diffInSeconds(now()) < self::COOLDOWN_SECONDS) {
            throw ValidationException::withMessages([
                'login' => 'Please wait before requesting a new code',
            ]);
        }

        // Генерация нового кода и отправка пользователю
        $newCode = $this->codeGenerator->generate();

        $user->verificationCodes()->create([
            'code' => $newCode,
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);

        dispatch(new \App\Jobs\SendVerificationCodeJob($user->id, $newCode));
    }
}
