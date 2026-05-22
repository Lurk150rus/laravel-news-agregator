<?php

declare(strict_types=1);

namespace App\Services\News;

final class NewsImportManager
{
    public function __construct(
        private iterable $importers
    ) {}

    public function importAll(): int
    {
        $totalImported = 0;

        foreach ($this->importers as $importer) {
            $totalImported += $importer->import();
        }

        return $totalImported;
    }
}
