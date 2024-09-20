<?php

namespace App\Domains\Order\Factories\Payment;

use App\Domains\Order\Data\InitPaymentResultData;
use App\Domains\Order\Services\UserOrder;

class StripeInitPaymentFactory extends AbstractInitPaymentFactory
{

    protected function initPayment(UserOrder $order): InitPaymentResultData
    {
        $this->user->syncOrCreateStripeCustomer();

        $payment = $this->user->createPayment($order->total()->getAmount(), ['receipt_email' => $this->user->email]);

        return new InitPaymentResultData($payment->id, ['clientSecret' => $payment->clientSecret()]);
    }
}
