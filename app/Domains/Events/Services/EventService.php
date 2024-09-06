<?php

namespace App\Domains\Events\Services;

use App\Domains\Common\Values\SortValue;
use App\Domains\Events\Data\EventData;
use App\Domains\Events\Models\Event;
use App\Domains\User\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EventService
{
    public function create(Authenticatable|User $user, EventData $data): Event
    {
        $event = $data->toModel();
        $event->user()->associate($user);
        $event->save();

        return $event;
    }

    public function update(Event $event, EventData $data): Event
    {
        $event = $data->toModel($event);
        $event->save();

        return $event;
    }

    public function list(Collection $filters = new Collection(), ?SortValue $sort = null): LengthAwarePaginator
    {
        $query = Event::query();
        $query->filter($filters);

        $sort?->applyTo($query);

        return $query->paginate();
    }
}
