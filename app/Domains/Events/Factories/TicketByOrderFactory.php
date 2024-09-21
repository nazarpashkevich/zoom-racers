<?php

namespace App\Domains\Events\Factories;

use App\Domains\Events\Models\Event;
use App\Domains\Events\Models\Ticket;
use App\Domains\Order\Models\Order;
use Illuminate\Support\Str;

class TicketByOrderFactory
{

    protected function __construct(protected Order $order, protected Event $event)
    {
    }

    public static function handle(Order $order, Event $event): Ticket
    {
        $self = new self($order, $event);

        return $self->createTicket();
    }

    protected function createTicket(): Ticket
    {
        $ticket = new Ticket();

        $ticket->fill([
            'contact_data' => $this->order->contact_data,
            'reference'    => Str::uuid(), // generate uniq id for ticket
        ]);

        $ticket->user()->associate($this->order->user_id);
        $ticket->event()->associate($this->event->getQueueableId());

        $ticket->save();

        return $ticket;
    }
}
