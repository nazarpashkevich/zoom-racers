<?php

namespace App\Domains\Events\Filters\Ticket;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ShowPast extends Filter
{
    public function filter(Builder $query): Builder
    {
        return $this->value
            ? $query
            : $query->whereRelation(
                'event',
                fn (Builder $builder) => $builder->where('end', '>=', Carbon::now())
            );
    }
}
