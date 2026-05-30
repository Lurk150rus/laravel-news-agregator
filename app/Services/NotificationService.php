<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function push(string $message, array $payload = [], string $type = null): void
    {
        Notification::create([
            'message' => $message,
            'type' => $type,
            'payload' => $payload,
        ]);
    }

    public static function pull(): array
    {
        $notifications = Notification::where('created_at', '>=', now()->subSeconds(20))
            ->get();

        Notification::whereIn('id', $notifications->pluck('id'))
            ->update(['is_read' => true]);

        return $notifications->all();
    }
}
