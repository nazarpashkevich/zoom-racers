<?php

namespace App\Domains\Events\Filters\Event;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class LanguageFilter extends Filter
{
    public function filter(Builder $query): Builder
    {
        return $query->whereIn('language', $this->value);
    }
}
