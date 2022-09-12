<?php

namespace App\Services;

use App\Interfaces\InvoiceInterface;
use App\Traits\ResponseAPI;

class InvoiceService
{
    use ResponseAPI;
    
    protected $invoiceInterface;

    public function __construct(InvoiceInterface $invoiceInterface)
    {
        $this->invoiceInterface = $invoiceInterface;
    }

    public function findAll($customer_id)
    {
        try {
            $data = $this->invoiceInterface->getAll($customer_id);
            return (!$data->isEmpty()) ? $this->success('All invoice\'s', $data): $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findOne($customer_id, $snap_token)
    {
        try {
            $data = $this->invoiceInterface->getOne($customer_id, $snap_token);
            return isset($data) ? $this->success('Invoice\'s detail', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}