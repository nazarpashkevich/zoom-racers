<?php

namespace App\Domains\Order\Http\Controllers;

use App\Domains\Order\Http\Requests\InitPaymentRequest;
use App\Domains\Order\Resolvers\InitPaymentResolver;
use App\Domains\Order\Services\UserOrder;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PaymentController
{
    use ApiResponseHelpers;

    public function __construct()
    {
    }

    public function init(InitPaymentRequest $request, UserOrder $order): JsonResponse
    {
        return $this->respondWithSuccess([
            'data' => InitPaymentResolver::resolve($request->gateway())
                ->handle(Auth::user(), $order),
        ]);
    }
}
