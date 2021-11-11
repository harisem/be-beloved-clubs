<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;

class CartRepository implements CartInterface
{
    public function getCarts($customer_id)
    {
        $carts = Cart::with('products')->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
        return $carts;
    }

    public function getCart($product_id, $customer_id)
    {
        $cart = Cart::where('product_id', $product_id)->where('customer_id', $customer_id);
        return $cart;
    }

    public function store($request, $product, $customer)
    {
        $cart = new Cart([
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'weight' => $request['weight'],
        ]);
        $cart->customers()->associate($customer);
        $cart->products()->associate($product);
        $cart->save();
        return true;
    }

    public function update($request, $cart)
    {
        $cart->increment('quantity');
        $cart = $cart->first();
        $price = $request['price'] * $cart->quantity;
        $weight = $request['weight'] * $cart->quantity;
        $cart->update([
            'price' => $price,
            'weight' => $weight
        ]);
        return true;
    }

    public function getCartTotalPrice($customer_id)
    {
        $carts = Cart::with('products')->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->sum('price');
        return $carts;
    }

    public function getCartTotalWeight($customer_id)
    {
        $carts = Cart::with('products')->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->sum('weight');
        return $carts;
    }

    public function deleteCart($id)
    {
        Cart::whereId($id)->delete();
        return true;
    }

    public function deleteCarts($customer_id)
    {
        Cart::where('customer_id', $customer_id)->delete();
        return true;
    }
}