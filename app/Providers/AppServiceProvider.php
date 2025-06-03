<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\GameRepositoryInterface;
use App\Repositories\GameRepository;
use Carbon\Carbon;
use Laravel\Passport\Passport;

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
        Passport::tokensExpireIn(Carbon::now()->addMinutes(10));
        Passport::refreshTokensExpireIn(now()->addMinutes(30));
        Passport::enablePasswordGrant();
    }
}
