<?php

namespace App\Clients;

class LocalSmsClient
{
    public function sendSms(string $phone, string $message, string $senderId): array
    {
        return [
            'message_id' => 'local_9',
            'phone' => $phone,
            'text' => $message,
            'sender' => $senderId,
        ];
    }
}