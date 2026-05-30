<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserRegisteredNotification
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
    public function handle(UserRegistered $event): void
    {
        NotificationService::push(
            "Новый пользователь зарегестрирован: {$event->user->login}"
        );
    }
}
