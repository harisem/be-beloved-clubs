<?php

namespace App\Services;

use App\Interfaces\CartInterface;
use App\Interfaces\CustomerInterface;
use App\Interfaces\ProductInterface;
use App\Traits\ResponseAPI;

class CartService
{
    use ResponseAPI;

    protected $cartInterface;
    protected $productInterface;
    protected $customerInterface;

    public function __construct(CartInterface $cartInterface, ProductInterface $productInterface, CustomerInterface $customerInterface)
    {
        $this->cartInterface = $cartInterface;
        $this->productInterface = $productInterface;
        $this->customerInterface = $customerInterface;
    }

    public function getAll($customer_id)
    {
        try {
            $data = $this->cartInterface->getCarts($customer_id);
            return (!$data->isEmpty()) ? $this->success('Products fetched successfully', $data) : $this->error('No data found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createOrUpdate($request, $product_id, $customer_id)
    {
        $cartItem = $this->cartInterface->getCart($product_id, $customer_id);
        if ($cartItem->count()) {
            try {
                $request = [
                    'price' => $request['price'],
                    'weight' => $request['weight']
                ];
                $data = $this->cartInterface->update($request, $cartItem);
                return $this->success('Cart\'s updated.', null);
            } catch (\Exception $e) {
                return $this->error($e->getMessage());
            }
            
        } else {
            try {
                $customer = $this->customerInterface->getCustomerById($customer_id);
                $product = $this->productInterface->getProductById($product_id);
                $request = [
                    'quantity' => $request['quantity'],
                    'price' => $request['price'],
                    'weight' => $request['weight']
                ];
                $data = $this->cartInterface->store($request, $product, $customer);
                return $this->success('Cart\'s created', null, 201);
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $e->getCode());
            }
        }
    }

    public function getTotalPrice($customer_id)
    {
        try {
            $data = $this->cartInterface->getCartTotalPrice($customer_id);
            return $this->success('Total price', $data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getTotalWeight($customer_id)
    {
        try {
            $data = $this->cartInterface->getCartTotalWeight($customer_id);
            return $this->success('Total weight', $data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function removeCart($id)
    {
        try {
            $data = $this->cartInterface->deleteCart($id);
            return $this->success('Cart removed', $data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function removeCarts($customer_id)
    {
        try {
            $data = $this->cartInterface->deleteCarts($customer_id);
            return $this->success('All Carts removed', $data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}