<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    
    public function __construct(CartService $cartService)
    {
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
        $this->cartService = $cartService;
    }

    public function index()
    {
        $data = $this->cartService->getAll($this->user->id);
        return $data;
    }

    public function store(Request $request)
    {
        $data = $this->cartService->createOrUpdate($request->except('product_id'), $request->only('product_id'), $this->user->id);
        return $data;
    }

    public function getCartTotalPrice()
    {
        $data = $this->cartService->getTotalPrice($this->user->id);
        return $data;
    }

    public function getCartTotalWeight()
    {
        $data = $this->cartService->getTotalWeight($this->user->id);
        return $data;
    }

    public function removeCart(Request $request)
    {
        $data = $this->cartService->removeCart($request->cart_id);
        return $data;
    }

    public function removeCarts(Request $request)
    {
        $data = $this->cartService->removeCarts($this->user->id);
        return $data;
    }
}
