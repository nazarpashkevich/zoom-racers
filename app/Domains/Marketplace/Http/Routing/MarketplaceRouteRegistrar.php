<?php

namespace App\Domains\Marketplace\Http\Routing;

use App\Domains\Common\Http\Routing\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Inertia\Inertia;

class MarketplaceRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->group(['prefix' => 'marketplace', 'as' => 'marketplace.'], function (Registrar $route) {
            $route->get('/', fn () => Inertia::render('Dashboard'))->name('index');
        });
    }
}
