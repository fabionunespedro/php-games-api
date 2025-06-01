<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\GameRepositoryInterface;
use App\Repositories\GameRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
