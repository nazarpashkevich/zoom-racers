<?php

namespace App\Providers;

use App\Domains\Auth\Http\Routing\AuthRouteRegistrar;
use App\Domains\Common\Http\Routing\RouteRegistrar;
use App\Domains\Events\Http\Routing\EventsRouteRegistrar;
use App\Domains\Home\Http\Routing\HomeRouteRegistrar;
use App\Domains\Marketplace\Http\Routing\MarketplaceRouteRegistrar;
use App\Domains\User\Http\Routing\UserRouteRegistrar;
use App\Domains\VirtualSpaces\Http\Routing\VirtualSpacesRouteRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

class RouteServiceProvider extends ServiceProvider
{
    protected array $registrars = [
        AuthRouteRegistrar::class,
        EventsRouteRegistrar::class,
        HomeRouteRegistrar::class,
        MarketplaceRouteRegistrar::class,
        UserRouteRegistrar::class,
        VirtualSpacesRouteRegistrar::class,
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for(
            'api',
            fn (Request $request) => Limit::perMinute(240)->by($request->user()?->id ?? $request->ip())
        );

        $this->routes(function (Registrar $router) {
            $this->mapRoutes($router, $this->registrars);
        });
    }

    protected function mapRoutes(Registrar $router, array $registrars): void
    {
        foreach ($registrars as $registrar) {
            if (!class_exists($registrar) || !is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(
                    sprintf('Cannot map routes \'%s\', it is not a valid routes class', $registrar)
                );
            }

            (new $registrar())->mapRoutes($router);
        }
    }
}
