<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Models\News;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewsCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsCreated $event): void
    {
        NotificationService::push(
            "Создана новая новость: {$event->news->title}"
        );
    }
}
