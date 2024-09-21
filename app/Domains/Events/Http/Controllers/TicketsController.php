<?php

namespace App\Domains\Events\Http\Controllers;

use App\Domains\Events\Data\TicketData;
use App\Domains\Events\Http\Requests\TicketsRequest;
use App\Domains\Events\Models\Ticket;
use App\Domains\Events\Services\TicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TicketsController
{
    public function __construct(protected TicketService $service)
    {
    }

    public function index(TicketsRequest $request): Response
    {
        $filters = $request->filters();
        $filters->put('user', Auth::id());

        $defaultFilters = ['showPast' => false, 'showCancelled' => false]; // @todo move somewhere?

        return Inertia::render('Tickets/Index', [
            'tickets' => TicketData::toWrap($this->service->list( // default filters
                $filters->merge(array_merge($defaultFilters, $filters->toArray()))
            )),
            'filters' => $filters,
        ]);
    }

    public function cancel(Ticket $ticket): RedirectResponse
    {
        $this->service->cancel($ticket);

        return redirect()->back();
    }

    public function archive(Ticket $ticket): RedirectResponse
    {
        $this->service->archive($ticket);

        return redirect()->back();
    }
}
