<?php

namespace App\Providers;

use App\Contracts\Contracts\PaymentGateway;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
