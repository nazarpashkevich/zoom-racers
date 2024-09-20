<?php

namespace App\Domains\Order\Data;

use Spatie\LaravelData\Data;

class UserOrderDetailsData extends Data
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
    ) {
    }
}
