<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        return $this->invoiceService->findAll($this->user->id);
    }

    public function show($snap_token)
    {
        return $this->invoiceService->findOne($this->user->id, $snap_token);
    }
}
