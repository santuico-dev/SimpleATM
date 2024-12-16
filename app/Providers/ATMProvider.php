<?php

namespace App\Providers;

use App\Services\ATMService;
use Illuminate\Support\ServiceProvider;

class ATMProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ATMService::class, function () {
            return new ATMService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
