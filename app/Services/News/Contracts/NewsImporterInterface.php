<?php

declare(strict_types=1);

namespace App\Services\News\Contracts;

interface NewsImporterInterface
{
    public function import(): int;

    
}
