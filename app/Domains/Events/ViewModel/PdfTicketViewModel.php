<?php

namespace App\Domains\Events\ViewModel;

use App\Domains\Events\Models\Ticket;

class PdfTicketViewModel
{
    public function __construct(protected Ticket $ticket)
    {
    }

    public function toArray(): array
    {
        return [
            'eventTitle' => $this->ticket->event->title,
            'eventDate'  => $this->ticket->event->start->format('d.m.Y H:i'),
            'category'   => $this->ticket->event->category->formatName(),
            'uniqueCode' => $this->ticket->reference,
            'userName'   => $this->ticket->contact_data['name'],
            'userEmail'  => $this->ticket->contact_data['email'],
        ];
    }
}
