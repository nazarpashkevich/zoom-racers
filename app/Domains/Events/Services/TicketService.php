<?php

namespace App\Domains\Events\Services;

use App\Domains\Events\Models\Ticket;
use Illuminate\Support\Collection;

class TicketService
{
    public function list(Collection $filters): Collection
    {
        $query = Ticket::query()
            ->with('event');
        $query->filter($filters);

        return $query->get();
    }

    public function cancel(Ticket $ticket): Ticket
    {
        $ticket->is_canceled = true;
        $ticket->ticket_path = null;
        $ticket->save();

        return $ticket;
    }

    public function archive(Ticket $ticket): Ticket
    {
        $ticket->is_archived = true;
        $ticket->save();

        return $ticket;
    }
}
