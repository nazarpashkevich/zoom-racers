<?php

namespace App\Domains\Order\Events;

use App\Domains\Order\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;

class OrderPayed
{
    use Dispatchable;

    public function __construct(public Order $order)
    {
    }
}
