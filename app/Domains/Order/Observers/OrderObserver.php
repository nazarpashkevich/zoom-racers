<?php

namespace App\Domains\Order\Observers;

use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Events\OrderPayed;
use App\Domains\Order\Models\Order;

class OrderObserver
{
    public function updated(Order $order): void
    {
        if ($order->wasChanged() && $order->status === OrderStatus::Paid) {
            event(new OrderPayed($order));
        }
    }
}
