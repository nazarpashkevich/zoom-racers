<?php

namespace App\Domains\Events\Events;

use App\Domains\Events\Models\Ticket;
use Illuminate\Foundation\Events\Dispatchable;

class TicketCreated
{
    use Dispatchable;

    public function __construct(public Ticket $ticket)
    {
    }
}
