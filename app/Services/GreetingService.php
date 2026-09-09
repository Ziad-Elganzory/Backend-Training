<?php

namespace App\Services;

use App\Contracts\Contracts\GreetingFormatter;
use InvalidArgumentException;

class GreetingService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private GreetingFormatter $greeting)
    {}

    public function welcomeUser(string $name)
    {
        return $this->greeting->format($name);
    }
}
