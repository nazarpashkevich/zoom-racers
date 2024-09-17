<?php

namespace App\Domains\Cart;

use App\Domains\Cart\Actions\LoadCartItemsDetailsAction;
use App\Domains\Cart\Data\CartData;
use App\Domains\Cart\Data\CartItemData;
use App\Domains\Cart\Enums\ProductableType;
use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Models\CartItem;
use App\Domains\Cart\Services\CartService;
use App\Domains\User\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session;

class UserCart extends Facade
{
    protected CartService $cartService;
    protected ?Cart $cart = null;

    public function __construct(protected Collection $items, ?User $user = null)
    {
        $this->cartService = app(CartService::class);

        if ($user instanceof User) {
            $this->cart = $this->cartService->forUser($user);
        }
    }

    public function addItem(CartItemData $data): Collection
    {
        // if item is already in basket
        if ($existsItem = $this->items->where('type', $data->type)->firstWhere('productId', $data->productId)) {
            $existsItem->quantity = $data->quantity;
        } else {
            $this->items->push($data);
        }

        $this->sync();

        return $this->items();
    }

    public function removeItem(CartItemData $data): Collection
    {
        $this->items = $this->items->reject(
            fn (CartItemData $item) => $item->productId === $data->productId && $item->type === $data->type
        );

        $this->sync();

        return $this->items();
    }

    public function items(): Collection
    {
        return $this->items;
    }

    public function clear(): void
    {
        $this->items = $this->items->filter(fn () => false);
        $this->sync();
    }

    public function sync(): void
    {
        $this->syncWithSession();
        $this->syncWithDatabase();
    }

    public function syncWithSession(): void
    {
        Session::put('cart', ['items' => $this->items]);
    }

    public function syncWithDatabase(): void
    {
        if ($this->cart) {
            // @todo postpone
            $toDelete = $this->cart->items->filter(
                fn (CartItem $item) => is_null(
                    $this->items->where('type', ProductableType::fromModel($item->productable_type))
                        ->firstWhere('productId', $item->productable_id)
                )
            )->pluck('id');

            if ($toDelete->isNotEmpty()) {
                $this->cart->items()->whereIn('id', $toDelete)->delete();
            }

            $this->items->each(
                fn (CartItemData $item) => $item->toModel(
                    $this->cart,
                    $this->cart->items
                        ->where('productable_type', $item->type->getModel())
                        ->firstWhere('productable_id', $item->productId)
                )->save()
            );
        }
    }

    public function toData(bool $detailed = false): CartData
    {
        if ($detailed) {
            $this->loadDetails();
        }

        return CartData::fromItems($this->items);
    }

    protected function loadDetails(): void
    {
        app(LoadCartItemsDetailsAction::class)->handle($this->items);
    }
}
