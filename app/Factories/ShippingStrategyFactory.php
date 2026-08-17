<?php

namespace App\Factories;

use App\Strategies\Shipping\FlatRateShippingStrategy;
use App\Strategies\Shipping\FreeShippingStrategy;
use App\Strategies\Shipping\WeightBasedShippingStrategy;
use Exception;
use Illuminate\Contracts\Container\Container;

class ShippingStrategyFactory
{
    public function __construct(private Container $container){}
    public function make(string $strategy)
    {
        $class = match($strategy){
            "flat_rate"=> FlatRateShippingStrategy::class,
            "weight_based" => WeightBasedShippingStrategy::class,
            "free"=> FreeShippingStrategy::class,
            "default" => throw new Exception("Unsupported Strategy")
        };
        return $this->container->make($class);
    }
}