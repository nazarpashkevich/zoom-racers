<?php

namespace App\Domains\Dashboard\Http\Routing;

use App\Domains\Common\Http\Routing\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class DashboardRouteRegistrar extends RouteRegistrar
{
    protected array $middlewares = ['auth', 'web'];

    public function map(Registrar $route): void
    {
        $route->get('/', function () {
            return Inertia::render('Dashboard', [
                'canLogin'       => Route::has('login'),
                'canRegister'    => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion'     => PHP_VERSION,
            ]);
        })->name('dashboard');
    }
}
