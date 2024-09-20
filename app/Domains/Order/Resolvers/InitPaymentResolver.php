<?php

namespace App\Domains\Order\Resolvers;

use App\Domains\Order\Enums\PaymentGateway;
use App\Domains\Order\Factories\Payment\AbstractInitPaymentFactory;
use App\Domains\Order\Factories\Payment\StripeInitPaymentFactory;

class InitPaymentResolver
{
    public static function resolve(PaymentGateway $gateway): AbstractInitPaymentFactory
    {
        return match ($gateway) {
            PaymentGateway::Stripe => StripeInitPaymentFactory::make()
        };
    }
}
