<?php

namespace App\Domains\Order\Services;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Domains\Cart\Data\CartData;
use App\Domains\Cart\Services\UserCart;
use App\Domains\Order\Data\UserOrderData;
use App\Domains\Order\Data\UserOrderDetailsData;
use App\Domains\Order\Enums\TransactionStatus;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\Transaction;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Session;

/**
 * Manage order data (including calculations)
 */
class UserOrder
{
    protected CartData $cartData;
    protected ?Money $shipping = null;
    protected ?Money $total = null;

    public function __construct(protected User $user, protected UserOrderDetailsData $data, protected UserCart $cart)
    {
        $this->cartData = $this->cart->toData(detailed: true);
        $this->calculateTotals();
    }

    public function calculateTotals(): void
    {
        $this->shipping = $this->calculateShipping();
        $this->total = $this->shipping?->add($this->cartData->amount);
    }

    public function isUserDataFilled(): bool
    {
        return $this->data->name != '' && $this->data->email != '';
    }

    public function isDeliveryDataFilled(): bool
    {
        return $this->data->address != '';
    }

    public function update(UserOrderDetailsData $data): void
    {
        $this->data = $data;
        $this->saveToSession();
    }

    // save order to session
    public function saveToSession(): void
    {
        Session::put('order', $this->data);
    }

    public function toData(): UserOrderData
    {
        return new UserOrderData($this->data, $this->cartData, $this->shipping, $this->total());
    }

    protected function calculateShipping(): ?Money
    {
        // @todo calculate depends on the address, handle action/factory for it and maybe return data object
        return $this->data->address != '' ? new Money(5000, new Currency('USD')) : null;
    }

    public function total(): ?Money
    {
        return $this->total;
    }

    public function create(string $reference): Order
    {
        $order = $this->createOrder();
        $this->createTransaction($reference, $order);

        return $order;
    }

    public function createOrder(): Order
    {
        // order can be created only with cart
        if ($this->cart->cart) {
            $order = $this->toData()->toModel();
            $order->user()->associate($this->user);

            $order->save();
            $order->cart()->save($this->cart->cart);

            return $order;
        }

        throw new \Exception('Cart is empty');
    }

    public function createTransaction(string $reference, Order $order): void
    {
        $transaction = new Transaction();
        $transaction->fill([
            'reference' => $reference,
            'amount'    => $this->total,
            'currency'  => $this->total->getCurrency()->getCurrency(),
            'status'    => TransactionStatus::Created,
        ]);

        $transaction->order()->associate($order);

        $transaction->save();
    }
}
