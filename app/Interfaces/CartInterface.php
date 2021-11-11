<?php

namespace App\Interfaces;

interface CartInterface
{
    public function getCarts($customer_id);
    public function getCart($product_id, $customer_id);
    public function store($request, $product, $customer);
    public function update($request, $cart);
    public function getCartTotalPrice($customer_id);
    public function getCartTotalWeight($customer_id);
    public function deleteCart($id);
    public function deleteCarts($customer_id);
}