<?php

namespace App\Clients;

class TwilioClient
{

    public function messagesCreate(string $to, array $paylod) : array
    {
        return [
            'sid' => 'SM123',
            'to' => $to,
            'body' => $paylod['body']
        ];
    }
}