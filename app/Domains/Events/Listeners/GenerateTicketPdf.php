<?php

namespace App\Domains\Events\Listeners;

use App\Domains\Events\Events\TicketCreated;
use App\Domains\Events\Factories\PdfForTicketFactory;

class GenerateTicketPdf
{
    public function handle(TicketCreated $event): void
    {
        PdfForTicketFactory::handle($event->ticket);
    }
}
