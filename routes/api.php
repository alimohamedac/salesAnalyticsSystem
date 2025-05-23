<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\RecommendationController;

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/analytics', [AnalyticsController::class, 'index']);
Route::get('/recommendations', [RecommendationController::class, 'getRecommendations']);
Route::get('/weather-recommendations', [RecommendationController::class, 'getWeatherRecommendations']);
