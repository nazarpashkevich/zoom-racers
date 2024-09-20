<?php

namespace App\Domains\Order\Enums;

enum PaymentGateway: string
{
    case Stripe = 'stripe';
}
