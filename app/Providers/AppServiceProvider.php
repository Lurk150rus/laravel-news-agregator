<?php

namespace App\Providers;

use App\Services\Messenger\Contract\MessengerInterface;
use App\Services\Messenger\TelegramMessenger;
use App\Services\News\Importers\HackerNewsImporter;
use App\Services\News\NewsImportManager;
use Illuminate\Support\Facades\Blade;
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

        $this->app->bind(
            MessengerInterface::class,
            TelegramMessenger::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('verified', function () {
            return "<?php if(auth()->check() && auth()->user()->is_verified): ?>";
        });
        Blade::directive('endverified', function () {
            return "<?php endif; ?>";
        });
        Blade::directive('admin', function () {
            return "<?php if(auth()->check() && auth()->user()->is_admin): ?>";
        });
        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });
    }
}
