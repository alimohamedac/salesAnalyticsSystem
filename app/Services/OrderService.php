<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Http;

class OrderService
{
    protected $orderRepository;
    protected $webSocketServer;

    public function __construct(OrderRepository $orderRepository, WebSocketServer $webSocketServer)
    {
        $this->orderRepository = $orderRepository;
        $this->webSocketServer = $webSocketServer;
    }

    public function createOrder(array $data)
    {
        $order = $this->orderRepository->createOrder($data);

        $this->webSocketServer->broadcast([
            'event' => 'order_created',
            'data' => $order
        ]);

        $this->webSocketServer->broadcast([
            'event' => 'analytics_updated',
            'data' => $this->getAnalytics()
        ]);

        return $order;
    }

    public function getAnalytics()
    {
        return [
            'total_revenue' => $this->orderRepository->getTotalRevenue(),
            'recent_orders' => $this->orderRepository->getRecentOrders(),
            'top_products' => $this->orderRepository->getTopProducts()
        ];
    }

    public function getRecommendations()
    {
        $recentSales = $this->orderRepository->getRecentOrders(60); // Last hour
        $response = Http::post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Analyze these sales and suggest promotions or pricing strategies: ' . json_encode($recentSales)
                ]
            ]
        ]);

        return $response->json();
    }

    public function getWeatherBasedPricing($city)
    {
        $weather = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city,
            'appid' => config('services.openweather.key'),
            'units' => 'metric'
        ]);

        $temp = $weather->json()['main']['temp'] ?? null;

        if ($temp > 25) {
            return ['suggestion' => 'Promote cold drinks', 'discount' => 10];
        } elseif ($temp < 10) {
            return ['suggestion' => 'Promote hot drinks', 'discount' => 15];
        }

        return ['suggestion' => 'Standard pricing', 'discount' => 0];
    }
}
