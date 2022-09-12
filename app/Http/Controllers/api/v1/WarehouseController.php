<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\WarehouseService;

class WarehouseController extends Controller
{
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $data = $this->warehouseService->getWarehouses(request()->q);
        return $data;
    }
    
    public function show($slug)
    {
        $data = $this->warehouseService->getWarehouse($slug);
        return $data;
    }
}