<?php

namespace App\Domains\Order\Http\Routing;

use App\Domains\Common\Http\Routing\RouteRegistrar;
use App\Domains\Order\Http\Controllers\OrderController;
use App\Domains\Order\Http\Controllers\PaymentController;
use Illuminate\Contracts\Routing\Registrar;

class OrderRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->group(
            ['prefix' => 'order', 'controller' => OrderController::class, 'as' => 'order.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
                $route->post('', 'create')->name('create');
                $route->put('save', 'save')->name('save');
                $route->get('success', 'success')->name('success');
            }
        );

        $route->group(
            ['prefix' => 'payment', 'controller' => PaymentController::class, 'as' => 'payment.'],
            function (Registrar $route) {
                $route->get('init', 'init')->name('init');
            }
        );
    }
}
