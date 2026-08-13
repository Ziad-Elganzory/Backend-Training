<?php

namespace App\Providers;

use App\Services\NotificationSettingsManager;
use App\Services\TaxCalculatorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaxCalculatorService::class, function($app){
            return new TaxCalculatorService();
        });

        $this->app->singleton(NotificationSettingsManager::class, function($app){
            return new NotificationSettingsManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
