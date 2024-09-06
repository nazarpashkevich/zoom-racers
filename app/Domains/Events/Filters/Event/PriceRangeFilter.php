<?php

namespace App\Domains\Events\Filters\Event;

use App\Domains\Common\Filters\Filter;
use App\Domains\Events\Enums\PriceRange;
use Illuminate\Database\Eloquent\Builder;

class PriceRangeFilter extends Filter
{
    public function filter(Builder $query): Builder
    {
        if ($range = PriceRange::tryFrom($this->value)) {
            [$min, $max] = $range->getRange();

            if ($min && $max) {
                $query->whereBetween('price', [$min, $max]);
            } elseif ($max) {
                $query->where('price', '<', $max);
            } elseif ($min) {
                $query->where('price', '>', $min);
            }
        }


        return $query;
    }
}
