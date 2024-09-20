<?php

namespace App\Domains\Order\Data;

use Akaunting\Money\Money;
use App\Domains\Cart\Data\CartData;
use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Models\Order;
use Spatie\LaravelData\Data;

class UserOrderData extends Data
{
    public function __construct(
        public UserOrderDetailsData $details,
        public CartData $cart,
        public ?Money $shipping,
        public ?Money $total,
    ) {
    }

    public function toModel(Order|int|null $order = null): Order
    {
        if (is_int($order)) {
            $order = Order::query()->findOrFail($order);
        }

        $order ??= new Order();

        $order->fill([
            'contact_data' => $this->details->toArray(),
            'shipping'     => $this->shipping,
            'total'        => $this->total,
            'currency'     => $this->total->getCurrency()->getCurrency(),
            'status'       => OrderStatus::Created,
        ]);

        return $order;
    }
}
