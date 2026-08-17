<?php

namespace App\Observers;

use App\Contracts\UserObserverInterface;
use Illuminate\Support\Facades\Log;
use Override;

class SendWelcomeEmailObserver implements UserObserverInterface
{
    #[Override]
    public function handle(array $user): void
    {
        Log::info("Sending welcome email to {$user["email"]}");
    }
}