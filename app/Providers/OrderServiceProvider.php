<?php

namespace App\Providers;

use App\Domains\Cart\Services\UserCart;
use App\Domains\Order\Factories\UserOrderFactory;
use App\Domains\Order\Services\UserOrder;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->singleton(UserOrder::class, function ($app) {
            return UserOrderFactory::make(auth()->user(), app(UserCart::class));
        });
    }
}
