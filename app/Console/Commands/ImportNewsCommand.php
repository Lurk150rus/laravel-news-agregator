<?php

namespace App\Console\Commands;

use App\Services\News\Importers\HackerNewsImporter;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('news:import')]
#[Description('Import news from external sources')]
class ImportNewsCommand extends Command
{
    public function __construct( private HackerNewsImporter $importService )
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->importService->import();
        // Logic to import news from external sources
        $this->info('News imported successfully! Total imported: ' . $count);

        return self::SUCCESS;
    }
}
