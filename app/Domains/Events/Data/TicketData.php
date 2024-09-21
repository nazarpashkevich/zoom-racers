<?php

namespace App\Domains\Events\Data;

use App\Domains\Common\Contracts\Modelable;
use App\Domains\Common\Data\BaseData;
use App\Domains\Events\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class TicketData extends BaseData implements Modelable
{
    public function __construct(
        public string $reference,
        public ?string $ticketPath,
        public bool $isCanceled,
        public EventData $event,
        public ?int $id = null,
    ) {
    }

    public static function fromModel(Ticket|Model $model): self
    {
        return self::from([
            ...$model->toArray(),
            'event' => EventData::fromModel($model->event),
        ]);
    }
}
