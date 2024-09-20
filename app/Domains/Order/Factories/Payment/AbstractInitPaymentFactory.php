<?php

namespace App\Domains\Order\Factories\Payment;

use App\Domains\Order\Data\InitPaymentResultData;
use App\Domains\Order\Services\UserOrder;
use App\Domains\User\Models\User;

abstract class AbstractInitPaymentFactory
{
    public static function make(): static
    {
        return new static();
    }

    protected User $user;

    public function handle(User $user, UserOrder $order): InitPaymentResultData
    {
        $this->user = $user;

        return $this->initPayment($order);
    }

    abstract protected function initPayment(UserOrder $order): InitPaymentResultData;
}
