<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getAllProducts()
    {
        return DB::select('SELECT * FROM products');
    }

    public function getProductById($id)
    {
        return DB::selectOne('SELECT * FROM products WHERE id = ?', [$id]);
    }

    public function createProduct(array $data)
    {
        return DB::insert(
            'INSERT INTO products (name, category, price, created_at, updated_at) VALUES (?, ?, ?, ?, ?)',
            [$data['name'], $data['category'], $data['price'], now(), now()]
        );
    }
}
