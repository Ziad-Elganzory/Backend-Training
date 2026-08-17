<?php
namespace App\Subjects;

use App\Contracts\UserObserverInterface;
use Illuminate\Support\Facades\Log;

class UserRegisteredSubject
{
    private array $observers = [];

    public function attach(UserObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function notify(array $user)
    {
        foreach($this->observers as $observer){
            $observer->handle($user);
        }
    }

    public function registerUser(array $user)
    {
        Log::info("User {$user['name']} registered");
        $this->notify($user);
    }
}