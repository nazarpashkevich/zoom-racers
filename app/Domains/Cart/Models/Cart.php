<?php

namespace App\Domains\Cart\Models;

use App\Domains\Cart\Builders\CartBuilder;
use App\Domains\Common\Traits\Model\InteractWithBuilder;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \Illuminate\Database\Eloquent\Collection<\App\Domains\Cart\Models\CartItem> $items
 *
 * @method static \App\Domains\Cart\Builders\CartBuilder query()
 */
class Cart extends Model
{
    use InteractWithBuilder;

    public $customBuilder = CartBuilder::class;

    protected $guarded = [];

    protected $casts = [

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
