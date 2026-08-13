<?php

namespace App\Services\Notifications;

use App\Contracts\NotificationChannelInterface;

class EmailNotificationChannel implements NotificationChannelInterface
{
    public function send(string $to, string $message): array
    {
        return [
            'channel' => 'email',
            'to' => $to,
            'message' => $message,
            'status' => 'sent',
        ];
    }
}