<?php

namespace App\Interfaces;

interface InvoiceInterface
{
    public function getAll($customer_id);
    public function getOne($customer_id, $snap_token);
}