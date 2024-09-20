<?php

namespace App\Domains\Order\Data;

use Spatie\LaravelData\Data;

class InitPaymentResultData extends Data
{
    public function __construct(
        public readonly string $reference,
        public readonly array $details
    ) {
    }
}
