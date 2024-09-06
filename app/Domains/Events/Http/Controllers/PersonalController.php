<?php

namespace App\Domains\Events\Http\Controllers;

use App\Domains\Events\Data\EventData;
use App\Domains\Events\Http\Requests\EventRequest;
use App\Domains\Events\Models\Event;
use App\Domains\Events\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PersonalController
{
    public function __construct(protected EventService $service)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Events/Personal', [
            'events' => EventData::toWrap($this->service->list()),
        ]);
    }

    public function show(Event $event): Response
    {
        return Inertia::render('Events/Show', []);
    }

    public function edit(Event $event): Response
    {
        return Inertia::render('Events/Edit', ['event' => EventData::from($event)->toArray()]);
    }

    public function create(): Response
    {
        return Inertia::render('Events/Edit', []);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $event = $this->service->create(Auth::user(), $request->toData());

        return redirect(route('personal-events.edit', $event));
    }

    public function update(Event $event, EventRequest $request): RedirectResponse
    {
        $this->service->update($event, $request->toData());

        return redirect(route('personal-events.index'));
    }
}
