<?php

namespace App\Services;

use App\Interfaces\WarehouseInterface;
use App\Traits\ResponseAPI;

class WarehouseService
{
    use ResponseAPI;

    protected $warehouseInterface;

    public function __construct(WarehouseInterface $warehouseInterface)
    {
        $this->warehouseInterface = $warehouseInterface;
    }

    public function getWarehouses($query)
    {
        try {
            $data = $this->warehouseInterface->getWarehouses($query);
            return (!$data->isEmpty()) ? $this->success('Warehouses fetched successfully', $data) : $this->error('No data found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getWarehouse($slug)
    {
        try {
            $data = $this->warehouseInterface->getWarehouseBySlug($slug);
            return isset($data) ? $this->success('Warehouse: ' . $data->name, $data) : $this->error('No data found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}