<?php

namespace App\Observers;

use App\Contracts\UserObserverInterface;
use Illuminate\Support\Facades\Log;
use Override;

class CreateUserProfileObserver implements UserObserverInterface
{
    #[Override]
    public function handle(array $user): void
    {
        Log::info("Creating profile for {$user["name"]}");
    }
}