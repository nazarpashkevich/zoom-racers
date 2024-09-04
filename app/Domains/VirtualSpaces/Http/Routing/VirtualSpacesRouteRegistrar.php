<?php

namespace App\Domains\VirtualSpaces\Http\Routing;

use App\Domains\Common\Http\Routing\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Inertia\Inertia;

class VirtualSpacesRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->group(['prefix' => 'virtual', 'as' => 'virtual.'], function (Registrar $route) {
            $route->get('/', fn () => Inertia::render('Dashboard'))->name('index');
        });
    }
}
