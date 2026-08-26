<?php

namespace App\Factories;

use App\Adapters\LocalSmsAdapter;
use App\Adapters\TwilioSmsAdapter;
use App\Contracts\SmsSender;
use InvalidArgumentException;

class SmsSenderFactory
{
    public static function make(?string $driver = null): SmsSender
    {
        $driver ??= config('services.sms.driver', 'local');
    
        return match ($driver) {
            'twilio' => app()->make(TwilioSmsAdapter::class, [
                'from' => config('services.sms.twilio_from', '+10000000000'),
            ]),
            'local' => app()->make(LocalSmsAdapter::class, [
                'senderId' => config('services.sms.sender_id', 'OBJECTS'),
            ]),
            default => throw new InvalidArgumentException("Unknown SMS driver [{$driver}]."),
        };
    }
}