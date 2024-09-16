<?php

namespace App\Domains\Cart\Http\Routing;

use App\Domains\Cart\Http\Controllers\CartController;
use App\Domains\Common\Http\Routing\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;

class CartRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->group(
            ['prefix' => 'cart', 'controller' => CartController::class, 'as' => 'cart.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
                $route->get('list', 'list')->name('list');
                $route->post('', 'create')->name('create');
                $route->put('', 'update')->name('update');
                $route->delete('', 'delete')->name('delete');
                $route->get('clear', 'clear')->name('clear');
            }
        );
    }
}
