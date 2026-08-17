<?php

namespace App\Observers;

use App\Contracts\UserObserverInterface;
use Illuminate\Support\Facades\Log;
use Override;

class LogUserRegistrationObserver implements UserObserverInterface
{
    #[Override]
    public function handle(array $user): void
    {
        Log::info("Logging registration for {$user["name"]}");
    }
}