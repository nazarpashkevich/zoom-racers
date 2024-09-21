<?php

namespace App\Domains\Order\Factories;

use App\Domains\Cart\Services\UserCart;
use App\Domains\Order\Data\UserOrderDetailsData;
use App\Domains\Order\Services\UserOrder;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Session;

class UserOrderFactory
{
    public function __construct()
    {
    }

    public static function handle(User $user, UserCart $cart): UserOrder
    {
        $self = new static();

        return new UserOrder($user, $self->userOrderData(), $cart);
    }

    protected function userOrderData(): UserOrderDetailsData
    {
        return UserOrderDetailsData::from(Session::get('order', []));
    }
}
