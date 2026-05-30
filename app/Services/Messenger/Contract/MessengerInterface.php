<?php

declare(strict_types=1);

namespace App\Services\Messenger\Contract;

interface MessengerInterface
{
    public function send(string $message): void;
}
