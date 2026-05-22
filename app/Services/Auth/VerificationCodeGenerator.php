<?php

declare(strict_types=1);

namespace App\Services\Auth;

final class VerificationCodeGenerator
{
    public function generate(): string
    {
        return (string) random_int(100000, 999999);
    }
}
