<?php

namespace App\Domains\Events\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class TicketsController
{
    public function index(): Response
    {
        return Inertia::render('Tickets/Index', []);
    }
}
