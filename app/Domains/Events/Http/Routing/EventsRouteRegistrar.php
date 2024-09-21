<?php

namespace App\Domains\Events\Http\Routing;

use App\Domains\Common\Http\Actions\GetApiDictionaryAction;
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
                $route->get('dictionaries/{dictionary}', GetApiDictionaryAction::class)->name('dictionary');
                $route->get('{event}', 'show')->name('show');
            }
        );


        $route->group(
            ['prefix' => 'personal-events', 'controller' => PersonalController::class, 'as' => 'personal-events.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
                $route->post('', 'store')->name('store');
                $route->get('create', 'create')->name('create');
                $route->get('{event}', 'edit')->name('edit');
                $route->put('{event}', 'update')->name('update');
            }
        );

        $route->group(
            ['prefix' => 'tickets', 'controller' => TicketsController::class, 'as' => 'tickets.'],
            function (Registrar $route) {
                $route->get('', 'index')->name('index');
                $route->get('{ticket}/cancel', 'cancel')->name('cancel');
                $route->get('{ticket}/archive', 'archive')->name('archive');
            }
        );
    }
}
