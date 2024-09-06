<?php

namespace App\Domains\Events\Filters\Event;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateRangeFilter extends Filter
{
    public function filter(Builder $query): Builder
    {
        [$start, $end] = $this->value;

        return $query->whereDate('start', '<=', $end)
            ->whereDate('start', '>=', $start);
    }
}
