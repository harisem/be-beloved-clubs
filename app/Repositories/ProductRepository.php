<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function getProducts($query)
    {
        $products = Product::with('warehouses')->latest()->when($query, function ($products) use ($query) {
            $products = $products->where('name', 'like', '%' . $query . '%');
        })->paginate(10);

        return $products;
    }

    public function getProductById($id)
    {
        $product = Product::findOrFail($id)->first();
        return $product;
    }

    public function getProductBySlug($slug)
    {
        $product = Product::with('warehouses')->where('slug', $slug)->first();
        return $product;
    }
}