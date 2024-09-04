<?php

namespace App\Domains\Events\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class EventsController
{

    public function index(): Response
    {
        return Inertia::render('Events/Index', []);
    }

    public function show($event): Response
    {
        return Inertia::render('Events/Show', []);
    }
}
