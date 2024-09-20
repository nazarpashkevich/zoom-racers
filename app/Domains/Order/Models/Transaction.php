<?php

namespace App\Domains\Order\Models;

use App\Domains\Common\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{

    protected $guarded = [];

    protected $casts = [
        'amount' => MoneyCast::class,
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
