<?php

namespace App\Adapters;

use App\Clients\TwilioClient;
use App\Contracts\SmsSender;
use Override;

class TwilioSmsAdapter implements SmsSender
{
    public function __construct(
        private TwilioClient $twilio,
        private string $from
    ){}

    #[Override]
    public function send(string $to, string $message): string
    {
        $result = $this->twilio->messagesCreate($to,[
            'from' => $this->from,
            'body' => $message
        ]);

        return $result['sid'];
    }
}