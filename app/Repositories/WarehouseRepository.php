<?php

namespace App\Repositories;

use App\Interfaces\WarehouseInterface;
use App\Models\Warehouse;

class WarehouseRepository implements WarehouseInterface
{
    public function getWarehouses($query)
    {
        $warehouses = Warehouse::latest()->when($query, function ($warehouses) use ($query) {
            $warehouses = $warehouses->where('name', 'like', '%' . $query . '%');
        })->paginate(10);

        return $warehouses;
    }

    public function getWarehouseById($id)
    {
        $warehouse = Warehouse::findOrFail($id)->first();
        return $warehouse;
    }

    public function getWarehouseBySlug($slug)
    {
        $warehouse = Warehouse::where('slug', $slug)->first();
        return $warehouse;
    }
}