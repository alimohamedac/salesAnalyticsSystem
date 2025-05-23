<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function getRecommendations()
    {
        $recommendations = $this->orderService->getRecommendations();

        return response()->json($recommendations);
    }

    public function getWeatherRecommendations(Request $request)
    {
        $request->validate(['city' => 'required|string']);
        $city = $request->input('city');

        $recommendations = $this->orderService->getWeatherBasedPricing($city);

        return response()->json($recommendations);
    }
}
