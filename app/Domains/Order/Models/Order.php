<?php

namespace App\Domains\Order\Models;

use App\Domains\Cart\Models\Cart;
use App\Domains\Common\Casts\MoneyCast;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{

    protected $guarded = [];

    protected $casts = [
        'contact_data' => 'json',
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
