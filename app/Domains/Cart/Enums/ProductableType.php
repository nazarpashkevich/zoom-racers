<?php

namespace App\Domains\Cart\Enums;

use App\Domains\Events\Models\Event;

enum ProductableType: string
{
    case Event = 'event';
    case Product = 'product';

    public function getModel()
    {
        return match ($this) {
            self::Product => Event::class,
            self::Event   => Event::class,
        };
    }
}
