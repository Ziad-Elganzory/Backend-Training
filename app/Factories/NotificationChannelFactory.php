<?php

namespace App\Factories;

use App\Contracts\NotificationChannelInterface;
use App\Services\Notifications\EmailNotificationChannel;
use App\Services\Notifications\SmsNotificationChannel;
use App\Services\Notifications\WhatsappNotificationChannel;
use Illuminate\Contracts\Container\Container;

class NotificationChannelFactory
{
    public function __construct(private Container $container){}
    public function make(string $channel): NotificationChannelInterface
    {
        $class = match ($channel){
            'email' => EmailNotificationChannel::class,
            'sms' => SmsNotificationChannel::class,
            'whatsapp' => WhatsappNotificationChannel::class,
            default => throw new \InvalidArgumentException("Invalid notification channel: $channel"),
        };
        return $this->container->make($class);
    }
}