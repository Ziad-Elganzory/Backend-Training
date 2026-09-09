<?php

namespace App\Contracts\Contracts;

interface GreetingFormatter
{
    public function format(string $name):string;
}
