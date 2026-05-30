<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;

class NotificationStreamController extends Controller
{
    public function stream()
    {
        return response()->stream(function () {
            while (ob_get_level()) {
                ob_end_flush();
            }

            @ini_set('output_buffering', 'off');
            @ini_set('zlib.output_compression', '0');
            set_time_limit(0);

            // Время между попытками переподключения (мс)
            echo "retry: 2000\n\n";
            @ob_flush();
            flush();
            $messages = NotificationService::pull();
            foreach ($messages as $message) {
                // Отправляем данные
                echo "data: " . json_encode([
                    'message' => $message->message,
                    'type' => $message->type,
                    'payload' => $message->payload,
                    'id' => $message->id,
                ]) . "\n\n";
            }


            @ob_flush();
            flush();
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
}
