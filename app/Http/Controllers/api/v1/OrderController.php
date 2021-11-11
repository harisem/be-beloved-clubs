<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    
    public function __construct(OrderService $orderService)
    {
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
        $this->orderService = $orderService;
    }

    public function index()
    {
        return $this->orderService->get_all($this->user->id);
    }

    public function show($snap_token)
    {
        return $this->orderService->get_one($this->user->id, $snap_token);
    }

    // public function index()
    // {
    //     $invoices = Invoice::where('customer_id', auth('api')->user()->id)->latest()->get();

    //     return response()->json([
    //         'data' => $invoices,
    //         'success' => true
    //     ], 200);
    // }

    // public function show($snap_token)
    // {
    //     $invoice = Invoice::where('customer_id', auth('api')->user()->id)->where('snap_token', $snap_token)->latest()->first();

    //     return response()->json([
    //         'data' => $invoice,
    //         'success' => true
    //     ], 200);
    // }
}
