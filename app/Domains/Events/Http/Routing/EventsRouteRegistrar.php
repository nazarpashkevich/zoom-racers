<?php

namespace App\Domains\Events\Http\Routing;

use App\Domains\Common\Http\Routing\RouteRegistrar;
use App\Domains\Events\Http\Controllers\EventsController;
use App\Domains\Events\Http\Controllers\PersonalController;
use App\Domains\Events\Http\Controllers\TicketsController;
use Illuminate\Contracts\Routing\Registrar;

class EventsRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->group(
            ['prefix' => 'events', 'controller' => EventsController::class, 'as' => 'events.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
                $route->get('{event}', 'show')->name('show');
            }
        );


        $route->group(
            ['prefix' => 'personal-events', 'controller' => PersonalController::class, 'as' => 'personal-events.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
                $route->get('{event}', 'edit')->name('edit');
            }
        );

        $route->group(
            ['prefix' => 'tickets', 'controller' => TicketsController::class, 'as' => 'tickets.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
            }
        );
    }
}
