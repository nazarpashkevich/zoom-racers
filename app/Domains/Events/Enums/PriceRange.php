<?php

namespace App\Domains\Events\Enums;

use App\Domains\Common\Traits\Enum\ApiDictionarible;

enum PriceRange: string
{
    use ApiDictionarible;

    case Low = 'low';
    case Medium = 'medium';
    case Upper = 'upper';
    case Expensive = 'expensive';

    public function getRange(): array
    {
        return match ($this) {
            self::Low       => [0, 5],
            self::Medium    => [5, 20],
            self::Upper     => [20, 50],
            self::Expensive => [50, null],
        };
    }


    public static function toResource(self $enum): array
    {
        $range = $enum->getRange();

        return [
            'value' => $enum->value,
            'title' => $range[0] . ($range[1] ? "-$range[1]" : '+'),
        ];
    }
}
