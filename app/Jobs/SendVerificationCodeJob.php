<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VerificationCode;
use App\Services\Messenger\Contract\MessengerInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendVerificationCodeJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $userId,
        public string $code,
        public int $verificationId
    ) {}

    /**
     * Execute the job.
     */
    public function handle(MessengerInterface $messenger): void
    {
        $user = User::find($this->userId);

        if (!$user || $user->is_verified) {
            return;
        }

        $verification = VerificationCode::findOrFail($this->verificationId);

        try {
            $messageText = "For user {$user->login} verification code: {$this->code}";

            $messenger->send($messageText);

            $verification->update([
                'sent_at' => now(),
            ]);

        } catch (\Throwable $e) {

            report($e);

            throw $e;
        }

        Log::info("Sending verification code {$this->code} to user {$user->login}");
    }
}
