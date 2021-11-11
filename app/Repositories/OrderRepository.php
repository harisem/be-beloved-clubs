<?php

namespace App\Repositories;

use App\Interfaces\OrderInterface;
use App\Models\Order;

class OrderRepository implements OrderInterface
{
    public function findAll($customer_id)
    {
        $orders = Order::with('invoices')->whereHas('invoices', function ($query) use ($customer_id) {
            $query->where('customer_id', $customer_id);
        })->latest()->get();
        return $orders;
    }

    public function findOne($customer_id, $snap_token)
    {
        $orders = Order::with('invoices')->whereHas('invoices', function ($query) use ($customer_id, $snap_token) {
            $query->where('customer_id', $customer_id)
                ->where('snap_token', $snap_token);
        })->latest()->get();
        return $orders;
    }

    public function findOneByInvoice($invoice_id)
    {
        $orders = Order::where('invoice_id', $invoice_id)->get();
        return $orders;
    }

    public function create($data, $invoice, $product)
    {
        $order = new Order([
            'image' => $data['frontImg'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'status' => 'pending'
        ]);
        $order->invoices()->associate($invoice);
        $product->orders()->save($order);
        return true;
    }

    public function paid($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'paid';
        $order->save();
        return true;
    }

    public function cancelled($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();
        return true;
    }
}