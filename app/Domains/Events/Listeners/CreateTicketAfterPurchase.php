<?php

namespace App\Domains\Events\Listeners;

use App\Domains\Cart\Enums\ProductableType;
use App\Domains\Cart\Models\CartItem;
use App\Domains\Events\Factories\TicketByOrderFactory;
use App\Domains\Order\Events\OrderPayed;

class CreateTicketAfterPurchase
{
    public function handle(OrderPayed $event): void
    {
        $order = $event->order;
        $order->loadMissing('cart.items.product');
        $order->cart->items?->each(
            fn (CartItem $item) => $item->getProductableType() === ProductableType::Event ?
                TicketByOrderFactory::handle($order, $item->productable) : null
        );
    }
}
