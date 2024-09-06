<?php

namespace App\Domains\Events\Filters\Event;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PlatformFilter extends Filter
{
    public function filter(Builder $query): Builder
    {
        return $query->whereIn('platform', $this->value);
    }
}
