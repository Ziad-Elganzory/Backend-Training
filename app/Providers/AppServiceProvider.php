<?php

namespace App\Providers;

use App\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);

        $this->app->bind(UserService::class,fn(Application $app) => new UserService($app->make(UserRepositoryInterface::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
