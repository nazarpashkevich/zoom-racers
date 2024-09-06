<?php

namespace App\Domains\Events\Http\Controllers;

use App\Domains\Events\Data\EventData;
use App\Domains\Events\Http\Requests\EventsRequest;
use App\Domains\Events\Models\Event;
use App\Domains\Events\Services\EventService;
use Inertia\Inertia;
use Inertia\Response;

class EventsController
{
    public function __construct(protected EventService $service)
    {
    }

    public function index(EventsRequest $request): Response
    {
        $filters = $request->filters();

        return Inertia::render('Events/Index', [
            'events'  => EventData::toWrap($this->service->list($filters, $request->sort())),
            'filters' => $filters,
        ]);
    }

    public function show(Event $event): Response
    {
        return Inertia::render('Events/Show', []);
    }
}
