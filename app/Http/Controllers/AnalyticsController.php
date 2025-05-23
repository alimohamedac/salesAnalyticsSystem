<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

class AnalyticsController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $analytics = $this->orderService->getAnalytics();

        return response()->json(['data' => $analytics]);
    }
}
