<?php

namespace App\Domains\Order\Http\Controllers;

use App\Domains\Order\Http\Requests\OrderCreateRequest;
use App\Domains\Order\Http\Requests\OrderDetailsRequest;
use App\Domains\Order\Services\OrderService;
use App\Domains\Order\Services\UserOrder;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderController
{
    use ApiResponseHelpers;

    public function __construct(protected OrderService $service)
    {
    }

    public function index(Request $request, UserOrder $order): Response
    {
        $step = $request->integer('step', 1);

        $step = !$order->isUserDataFilled() && $step > 1 ? 1 : $step;
        $step = !$order->isDeliveryDataFilled() && $step > 2 ? 2 : $step;


        return Inertia::render('Order/Index', [
            'order' => $order->toData(),
            'step'  => $step,
        ]);
    }

    public function save(OrderDetailsRequest $request, UserOrder $order): RedirectResponse
    {
        $order->update($request->toData());

        return redirect()->route('order.index', ['step' => $request->step()]);
    }

    public function success(): Response
    {
        return Inertia::render('Order/Success');
    }

    public function create(OrderCreateRequest $request, UserOrder $order): JsonResponse
    {
        $order->create($request->reference());

        return $this->respondCreated();
    }
}
