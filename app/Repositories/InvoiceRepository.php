<?php

namespace App\Repositories;

use App\Interfaces\InvoiceInterface;
use App\Models\Invoice;

class InvoiceRepository implements InvoiceInterface
{
    public function getAll($customer_id)
    {
        $invoices = Invoice::with('orders.warehouses')->where('customer_id', $customer_id)->get();
        return $invoices;
    }

    public function getOne($customer_id, $snap_token)
    {
        $invoices = Invoice::with('orders')->where('customer_id', $customer_id)->where('snap_token', $snap_token)->get();
        return $invoices;
    }
}