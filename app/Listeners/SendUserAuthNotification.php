<?php

namespace App\Listeners;

use App\Events\UserAuth;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserAuthNotification
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
    public function handle(UserAuth $event): void
    {
        $is_verirified_message = $event->user->is_verified
            ? "User is verified."
            : "User is not verified.";

        NotificationService::push(
            "User authenticated: {$event->user->login}. {$is_verirified_message}"
        );
    }
}
