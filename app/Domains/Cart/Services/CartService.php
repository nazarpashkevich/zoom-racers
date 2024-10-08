<?php

namespace App\Domains\Cart\Services;

use App\Domains\Cart\Models\Cart;
use App\Domains\User\Models\User;

class CartService
{
    public function forUser(User $user): ?Cart
    {
        return Cart::query()
            ->whereNull('order_id')
            ->firstOrCreate(['user_id' => $user->getQueueableId()]);
    }
}
