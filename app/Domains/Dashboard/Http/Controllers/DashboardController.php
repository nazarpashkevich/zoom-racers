<?php

namespace App\Domains\Dashboard\Http\Controllers;

use App\Domains\Dashboard\Services\DashboardService;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController
{
    use ApiResponseHelpers;

    public function __construct(protected DashboardService $service)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Dashboard/Index');
    }

    public function newUsers(): JsonResponse
    {
        return $this->respondWithSuccess($this->service->newUsers());
    }

    public function totalUsers(): JsonResponse
    {
        return $this->respondWithSuccess($this->service->totalUsers());
    }

    public function revenue(): JsonResponse
    {
        return $this->respondWithSuccess($this->service->revenue());
    }

    public function orders(): JsonResponse
    {
        return $this->respondWithSuccess($this->service->orders());
    }
}
