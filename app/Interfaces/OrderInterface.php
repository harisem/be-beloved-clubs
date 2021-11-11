<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function findAll($customer_id);
    public function findOne($customer_id, $snap_token);
    public function findOneByInvoice($invoice_id);
    public function create($data, $invoice, $product);
    public function paid($id);
    public function cancelled($id);
}