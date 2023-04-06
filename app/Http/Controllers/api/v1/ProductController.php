<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $data = $this->productService->getProducts($request->q);
        return $data;
    }

    public function show($slug)
    {
        $data = $this->productService->getProduct($slug);
        return $data;
    }
}
