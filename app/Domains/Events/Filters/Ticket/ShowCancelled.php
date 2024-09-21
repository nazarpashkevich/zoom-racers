<?php

namespace App\Domains\Events\Filters\Ticket;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ShowCancelled extends Filter
{
    public function filter(Builder $query): Builder
    {
        return $this->value ? $query : $query->where('is_canceled', false);
    }
}
