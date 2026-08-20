<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function send(string $email, string $message)
    {
        Log::info("Email sent to {$email}: {$message}");
        return "Email sent to {$email}: {$message} ";
    }
}