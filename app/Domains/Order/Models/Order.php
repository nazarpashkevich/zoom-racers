<?php

namespace App\Domains\Order\Models;

use App\Domains\Cart\Models\Cart;
use App\Domains\Common\Casts\MoneyCast;
use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Observers\OrderObserver;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property \App\Domains\Order\Enums\OrderStatus $status
 * @property array                                $contact_data
 * @property \Akaunting\Money\Money               $shipping
 * @property \Akaunting\Money\Money               $total
 * @property int                                  $user_id
 *
 * @property \App\Domains\Cart\Models\Cart        $cart
 */
#[ObservedBy([OrderObserver::class])]
class Order extends Model
{

    protected $guarded = [];

    protected $casts = [
        'contact_data' => 'json',
        'status'       => OrderStatus::class,
        'shipping'     => MoneyCast::class,
        'total'        => MoneyCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
}
