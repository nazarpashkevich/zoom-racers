<?php

namespace App\Domains\Common\Data;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

abstract class BaseData extends Data
{
    public static function toWrap(LengthAwarePaginator|Collection $items): PaginatedDataCollection|DataCollection
    {
        if ($items instanceof Collection) {
            return static::collect($items, DataCollection::class)->wrap('data');
        }

        return static::collect($items, PaginatedDataCollection::class)->wrap('data');
    }
}
