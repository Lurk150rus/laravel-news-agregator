<?php

namespace App\Providers;

use App\Services\News\Importers\HackerNewsImporter;
use App\Services\News\NewsImportManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->tag([
            HackerNewsImporter::class,
        ], 'news.importers');
        $this->app->bind(
            NewsImportManager::class,
            fn($app) => new NewsImportManager(
                $app->tagged('news.importers')
            )
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
