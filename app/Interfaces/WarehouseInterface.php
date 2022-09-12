<?php

namespace App\Interfaces;

interface WarehouseInterface
{
    public function getWarehouses($query);
    public function getWarehouseById($id);
    public function getWarehouseBySlug($slug);
}