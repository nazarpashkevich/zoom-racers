<?php

namespace App\Domains\Cart\Factories;

use App\Domains\Cart\Data\CartItemData;
use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Models\CartItem;
use App\Domains\Cart\UserCart;
use App\Domains\User\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class UserCartFactory
{
    private function __construct(protected ?User $user = null)
    {
    }

    /**
     * Get user basket (basket can be got from session or database)
     */
    public static function make(?User $user = null): UserCart
    {
        return (new self($user))->makeCart();
    }

    public function makeCart(): UserCart
    {
        return new UserCart($this->items(), $this->user);
    }

    public function items(): Collection
    {
        if ($this->user && $items = $this->dbItems()) { // get from database
            return $items;
        }

        return $this->sessionItems();
    }

    public function dbItems(): ?Collection
    {
        if ($cart = Cart::query()->forUser($this->user)->first()) {
            return $cart->items->map(fn (CartItem $item) => CartItemData::fromModel($item));
        }

        return null;
    }

    public function sessionItems(): Collection
    {
        return CartItemData::collect(Session::get('cart.items', []), Collection::class);
    }
}
