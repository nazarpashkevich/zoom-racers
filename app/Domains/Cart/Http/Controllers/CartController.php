<?php

namespace App\Domains\Cart\Http\Controllers;

use App\Domains\Cart\Http\Requests\CartRequest;
use App\Domains\Cart\Services\CartService;
use App\Domains\Cart\Services\UserCart;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CartController
{
    use ApiResponseHelpers;

    public function __construct(protected CartService $service, protected UserCart $cart)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Cart/Index', ['cart' => $this->cart->toData(true)]);
    }

    public function list(): JsonResponse
    {
        return $this->respondWithSuccess(['data' => $this->cart->toData(detailed: true)]);
    }

    public function create(CartRequest $request): RedirectResponse
    {
        $this->update($request);

        return redirect()->back();
    }

    public function update(CartRequest $request): JsonResponse
    {
        $this->cart->addItem($request->toData());

        return $this->list();
    }

    public function delete(CartRequest $request): JsonResponse
    {
        $this->cart->removeItem($request->toData());

        return $this->list();
    }

    public function clear(): RedirectResponse
    {
        $this->cart->clear();

        return redirect()->back();
    }
}
