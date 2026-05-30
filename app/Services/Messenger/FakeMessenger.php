<?php

declare(strict_types=1);

namespace App\Services\Messenger;

use App\Services\Messenger\Contract\MessengerInterface;
use Illuminate\Support\Facades\Http;

class FakeMessenger implements MessengerInterface
{
    public function send(string $message): void
    {
        // Do nothing, just fake
    }
}
