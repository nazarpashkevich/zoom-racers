<?php

namespace App\Domains\Order\Enums;

enum OrderStatus: string
{
    case Created = 'created';
    case Paid = 'paid';
}
