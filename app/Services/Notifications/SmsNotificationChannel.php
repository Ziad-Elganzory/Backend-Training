<?php

namespace App\Services\Notifications;

use App\Contracts\NotificationChannelInterface;

class SmsNotificationChannel implements NotificationChannelInterface
{
    public function send(string $to, string $message): array
    {
        return [
            'channel' => 'sms',
            'to' => $to,
            'message' => $message,
            'status' => 'sent',
        ];
    }
}