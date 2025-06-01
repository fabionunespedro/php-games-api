<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Managers\GameManager;
use App\Contracts\GameContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GameContract::class, GameManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
