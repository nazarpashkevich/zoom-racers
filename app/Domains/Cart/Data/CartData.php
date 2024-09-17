<?php

namespace App\Domains\Cart\Data;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CartData extends Data
{
    public function __construct(
        public Collection $items,
        public Money|Optional $amount,
        public int $count
    ) {
    }

    public static function fromItems(Collection $items): self
    {
        $data = [
            'items' => $items,
            'count' => $items->count(),
        ];

        if (!$items->first()?->productable instanceof Optional) {
            $data['amount'] = new Money(
                $items->sum(fn (CartItemData $item) => $item->productable->price->getAmount() * $item->quantity),
                new Currency('usd')
            ); // @todo currency
        }

        return self::from($data);
    }
}
