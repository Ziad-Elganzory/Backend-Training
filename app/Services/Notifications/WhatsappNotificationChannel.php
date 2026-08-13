<?php

namespace App\Services\Notifications;

use App\Contracts\NotificationChannelInterface;

class WhatsappNotificationChannel implements NotificationChannelInterface
{
    public function send(string $to, string $message): array
    {
        return [
            'channel' => 'whatsapp',
            'to' => $to,
            'message' => $message,
            'status' => 'sent',
        ];
    }
}