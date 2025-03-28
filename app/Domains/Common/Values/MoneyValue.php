<?php

namespace App\Domains\Common\Values;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;

class MoneyValue extends Money
{
    public static function make(int|float $amount, string $currency = 'usd'): static
    {
        return new self($amount, new Currency($currency));
    }
}
