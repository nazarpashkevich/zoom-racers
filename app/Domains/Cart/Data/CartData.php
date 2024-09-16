<?php

namespace App\Domains\Cart\Data;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CartData extends Data
{
    public function __construct(
        public Collection $items,
        public Money $amount,
        public int $count
    ) {
    }

    public static function fromItems(Collection $items): self
    {
        $amount = new Money(
            $items->sum(fn (CartItemData $item) => $item->productable->price->getAmount() * $item->quantity),
            new Currency('usd')
        ); // @todo currency

        return new self($items, $amount, $items->count());
    }
}
