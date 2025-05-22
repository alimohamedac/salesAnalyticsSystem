<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $data)
    {
        return DB::insert(
            'INSERT INTO orders (product_id, quantity, price, created_at, updated_at) VALUES (?, ?, ?, ?, ?)',
            [$data['product_id'], $data['quantity'], $data['price'], now(), now()]
        );
    }

    public function getTotalRevenue()
    {
        return DB::selectOne('SELECT SUM(price * quantity) as total FROM orders');
    }

    public function getRecentOrders($minutes = 1)
    {
        return DB::select(
            'SELECT * FROM orders WHERE created_at >= datetime("now", ?)',
            ["-{$minutes} minutes"]
        );
    }

    public function getTopProducts($limit = 5)
    {
        return DB::select(
            'SELECT product_id, SUM(quantity) as total_quantity 
             FROM orders 
             GROUP BY product_id 
             ORDER BY total_quantity DESC 
             LIMIT ?',
            [$limit]
        );
    }
}
