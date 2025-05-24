<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{

    public function test_order_submission_triggers_analytics_update()
    {
        $response = $this->postJson('/api/orders', [
            'product_id' => 1,
            'quantity' => 2,
            'price' => 9.99,
            'date' => now()->toDateTimeString(),
        ]);

        $response->assertStatus(201);

        $analytics = $this->getJson('/api/analytics')->json();

        $this->assertGreaterThan(0, $analytics['total_revenue']);
    }

}
