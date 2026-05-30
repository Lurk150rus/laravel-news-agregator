<?php

declare(strict_types=1);

namespace App\Services\Messenger;

use App\Services\Messenger\Contract\MessengerInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramMessenger implements MessengerInterface
{
    public function send(string $message): void
    {
        $response  = Http::post("https://api.telegram.org/bot" . config('services.telegram.token') . "/sendMessage", [
            'chat_id' => config('services.telegram.chat_id'),
            'text' => $message,
        ]);

        if ($response->failed()) {
            Log::error('Telegram failed', [
                'body' => $response->body(),
            ]);

            return;
        }
    }
}
