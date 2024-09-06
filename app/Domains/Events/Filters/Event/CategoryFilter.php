<?php

namespace App\Domains\Events\Filters\Event;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Filter
{
    public function filter(Builder $query): Builder
    {
        return $query->whereIn('category', $this->value);
    }
}
