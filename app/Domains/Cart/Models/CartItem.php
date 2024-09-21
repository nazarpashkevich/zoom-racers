<?php

namespace App\Domains\Cart\Models;

use App\Domains\Cart\Enums\ProductableType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int    $productable_id
 * @property string $productable_type
 * @property string $quantity
 */
class CartItem extends Model
{
    protected $guarded = [];

    protected $casts = [];

    public function product(): MorphTo
    {
        return $this->morphTo('productable', 'productable_type', 'productable_id');
    }

    public function getProductableType(): ProductableType // @todo change to cast
    {
        return ProductableType::fromModel($this->productable_type);
    }
}
