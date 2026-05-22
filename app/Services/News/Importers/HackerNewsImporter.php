<?php

declare(strict_types=1);

namespace App\Services\News\Importers;

use App\Services\News\Contracts\NewsImporterInterface;

final class HackerNewsImporter implements NewsImporterInterface
{

    /**
     * @inheritDoc
     */
    public function import(): int {
        return 0;
    }
}
