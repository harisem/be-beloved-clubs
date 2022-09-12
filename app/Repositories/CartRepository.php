<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;

class CartRepository implements CartInterface
{
    public function getCarts($customer_id)
    {
        $carts = Cart::with('warehouses')->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
        return $carts;
    }

    public function getCart($warehouse_id, $customer_id)
    {
        $cart = Cart::where('warehouse_id', $warehouse_id)->where('customer_id', $customer_id);
        return $cart;
    }

    public function store($request, $warehouse, $customer)
    {
        $cart = new Cart([
            'quantity' => $request['quantity'],
            'price' => $request['price'] * $request['quantity'],
            'weight' => $request['weight'] * $request['quantity'],
        ]);
        $cart->customers()->associate($customer);
        $cart->warehouses()->associate($warehouse);
        $cart->save();
        return true;
    }

    public function update($request, $cart)
    {
        // $cart->increment('quantity');
        $cart = $cart->first();
        $quantity = $request['quantity'];
        $price = $request['price'] * $quantity;
        $weight = $request['weight'] * $quantity;
        $cart->update([
            'quantity' => $quantity,
            'price' => $price,
            'weight' => $weight
        ]);
        return true;
    }

    public function getCartTotalPrice($customer_id)
    {
        $carts = Cart::with('warehouses')->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->sum('price');
        return $carts;
    }

    public function getCartTotalWeight($customer_id)
    {
        $carts = Cart::with('warehouses')->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->sum('weight');
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