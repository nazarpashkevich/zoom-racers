<?php

namespace App\Domains\Events\Observers;

use App\Domains\Events\Events\TicketCreated;
use App\Domains\Events\Models\Ticket;

class TicketObserver
{
    public function created(Ticket $ticket): void
    {
        event(new TicketCreated($ticket));
    }
}
