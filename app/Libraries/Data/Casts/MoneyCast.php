<?php

namespace App\Libraries\Data\Casts;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class MoneyCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if ($value instanceof Money) {
            return $value;
        }

        if (is_array($value)) {
            return new Money($value['amount'], $value['currency']);
        }

        return new Money($value * 100, new Currency('USD'));
    }
}
