<?php

namespace App\Providers;

use App\Domains\Cart\Factories\UserCartFactory;
use App\Domains\Cart\Services\UserCart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->singleton(UserCart::class, function ($app) {
            return UserCartFactory::make(auth()->user());
        });
    }
}
