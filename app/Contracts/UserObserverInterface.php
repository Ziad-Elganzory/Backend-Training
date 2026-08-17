<?php

namespace App\Contracts;

interface UserObserverInterface
{
    public function handle(array $user): void;
}