<?php

namespace App\Services;

use App\Interfaces\OrderInterface;
use App\Traits\ResponseAPI;

class OrderService
{
    use ResponseAPI;

    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    public function get_all($customer_id)
    {
        try {
            $data = $this->orderInterface->findAll($customer_id);
            return (!$data->isEmpty()) ? $this->success('All order\'s', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function get_one($customer_id, $snap_token)
    {
        try {
            $data = $this->orderInterface->findOne($customer_id, $snap_token);
            return isset($data) ? $this->success('Order\'s detail', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}