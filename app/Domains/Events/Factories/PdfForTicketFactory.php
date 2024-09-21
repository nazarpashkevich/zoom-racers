<?php

namespace App\Domains\Events\Factories;

use App\Domains\Events\Models\Ticket;
use App\Domains\Events\ViewModel\PdfTicketViewModel;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;

class PdfForTicketFactory
{

    protected function __construct(protected Ticket $ticket)
    {
    }

    public static function handle(Ticket $ticket): void
    {
        $self = new self($ticket);

        $self->generate();
    }

    protected function generate(): void
    {
        $path = $this->makeFilePath();

        Pdf::view('events.ticket', (new PdfTicketViewModel($this->ticket))->toArray())
            ->save(Storage::drive('public')->path($path));

        $this->ticket->update(['ticket_path' => Storage::url($path)]);
    }

    protected function makeFilePath(): string
    {
        return "tickets/{$this->ticket->reference}.pdf";
    }
}
