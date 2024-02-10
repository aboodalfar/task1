<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\{
    UserServiceInterface,
    UserService
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
