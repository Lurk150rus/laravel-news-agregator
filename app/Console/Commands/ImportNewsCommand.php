<?php

namespace App\Console\Commands;

use App\Services\News\NewsImportManager;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('news:import')]
#[Description('Import news from external sources')]
class ImportNewsCommand extends Command
{
    public function __construct( private NewsImportManager $importService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->importService->importAll();

        $this->info('News imported successfully! Total imported: ' . $count);

        return self::SUCCESS;
    }
}
