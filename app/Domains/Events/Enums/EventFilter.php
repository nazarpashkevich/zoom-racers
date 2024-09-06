<?php

namespace App\Domains\Events\Enums;

use App\Domains\Common\Filters\Filter;
use App\Domains\Events\Filters\Event\CategoryFilter;
use App\Domains\Events\Filters\Event\DateRangeFilter;
use App\Domains\Events\Filters\Event\LanguageFilter;
use App\Domains\Events\Filters\Event\PlatformFilter;
use App\Domains\Events\Filters\Event\PriceRangeFilter;

enum EventFilter: string
{
    case Language = 'language';
    case Category = 'category';
    case Platform = 'platform';
    case PriceRange = 'priceRange';
    case DateRange = 'date';

    public function createFilter(mixed $value): Filter
    {
        return match ($this) {
            self::Language   => new LanguageFilter($value),
            self::Category   => new CategoryFilter($value),
            self::Platform   => new PlatformFilter($value),
            self::PriceRange => new PriceRangeFilter($value),
            self::DateRange  => new DateRangeFilter($value),
        };
    }
}
