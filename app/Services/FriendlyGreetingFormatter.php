<?php

namespace App\Services;

use App\Contracts\Contracts\GreetingFormatter;
use Override;

class FriendlyGreetingFormatter implements GreetingFormatter
{
    #[Override]
    public function format(string $name): string
    {
        return "Hello, {$name}!";
    }
}
