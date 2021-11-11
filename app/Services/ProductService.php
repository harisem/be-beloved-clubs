<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Traits\ResponseAPI;

class ProductService
{
    use ResponseAPI;

    protected $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    public function getProducts($query)
    {
        try {
            $data = $this->productInterface->getProducts($query);
            return (!$data->isEmpty()) ? $this->success('Products fetched successfully', $data) : $this->error('No data found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getProduct($slug)
    {
        try {
            $data = $this->productInterface->getProductBySlug($slug);
            return isset($data) ? $this->success('Product: ' . $data->name, $data) : $this->error('No data found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}