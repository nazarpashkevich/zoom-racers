<?php

namespace App\Domains\Events\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PersonalController
{

    public function index(): Response
    {
        return Inertia::render('Events/Personal', []);
    }

    public function show($event): Response
    {
        return Inertia::render('Events/Show', []);
    }

    public function edit($event): Response
    {
        return Inertia::render('Events/Edit', []);
    }
}
