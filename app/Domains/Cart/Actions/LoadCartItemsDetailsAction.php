<?php

namespace App\Domains\Cart\Actions;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Domains\Cart\Data\CartItemData;
use App\Domains\Cart\Enums\ProductableType;
use Illuminate\Support\Collection;

class LoadCartItemsDetailsAction
{

    public function handle(Collection $items): void
    {
        // load details for all cart items using less as possible requests
        $grouped = $items->groupBy('type');
        $grouped->each(fn ($items, $key) => $this->loadDetailsFor(ProductableType::from($key), $items));
    }

    public function loadDetailsFor(ProductableType $type, Collection $items): void
    {
        $products = $type->getModel()::query()
            ->whereIn('id', $items->pluck('productId'))
            ->get();

        $items->each(function (CartItemData $item) use ($products) {
            $product = $products?->find($item->productId)?->toData() ?? null;
            $item->productable = $product;
            $item->amount = new Money(
                $product ? $product->price->getAmount() * $item->quantity : 0,
                new Currency('USD')
            ); // @todo currency
        });
    }
}
