<?php

namespace App\Domains\Dashboard\Http\Routing;

use App\Domains\Common\Http\Routing\RouteRegistrar;
use App\Domains\Dashboard\Http\Controllers\DashboardController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Redirect;

class DashboardRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->get('/', fn () => Redirect::route('dashboard.index'));

        $route->group([
            'controller' => DashboardController::class,
            'prefix'     => 'dashboard',
            'as'         => 'dashboard.',
        ], function (Registrar $router): void {
            $router->get('', 'index')->name('index');
            $router->get('new-users', 'newUsers')->name('new-users');
            $router->get('total-users', 'totalUsers')->name('total-users');
            $router->get('revenue', 'revenue')->name('revenue');
            $router->get('orders', 'orders')->name('orders');
        });
    }
}
