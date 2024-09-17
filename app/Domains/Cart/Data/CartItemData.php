<?php

namespace App\Domains\Cart\Data;

use Akaunting\Money\Money;
use App\Domains\Cart\Enums\ProductableType;
use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Models\CartItem;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CartItemData extends Data
{

    public function __construct(
        public int $productId,
        #[WithCast(EnumCast::class)]
        public ProductableType $type,
        public Optional|Data|null $productable,
        public Optional|Money $amount,
        public int $quantity = 1,
    ) {
    }

    public static function fromModel(CartItem $cartItem): self
    {
        return self::from([
            'productId' => $cartItem->productable_id,
            'type'      => ProductableType::fromModel($cartItem->productable_type),
            'quantity'  => $cartItem->quantity,
        ]);
    }

    public function toModel(Cart $cart, CartItem|int|null $cartItem = null): CartItem
    {
        if (is_int($cartItem)) {
            $cartItem = CartItem::query()->find($cartItem);
        }

        $cartItem ??= new CartItem();

        $cartItem->fill([
            'cart_id'          => $cart->getQueueableId(),
            'productable_id'   => $this->productId,
            'productable_type' => $this->type->getModel(),
            'quantity'         => $this->quantity,
        ]);

        return $cartItem;
    }
}
