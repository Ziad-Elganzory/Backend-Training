<?php

namespace App\Providers;

use App\Contracts\Contracts\GreetingFormatter;
use App\Contracts\Contracts\PaymentGateway;
use App\Services\FriendlyGreetingFormatter;
use App\Services\Payment\FakePaymentGateway;
use App\Services\Payment\PaymobPaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PaymentGateway::class,
            PaymobPaymentGateway::class
        );

        // $this->app->bind(
        //     PaymentGateway::class,
        //     FakePaymentGateway::class
        // );

        $this->app->bind(GreetingFormatter::class,FriendlyGreetingFormatter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
