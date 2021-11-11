<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    public function index()
    {
        return $this->catalogService->getAll();
    }

    public function show($slug)
    {
        return $this->catalogService->getOne($slug);
    }

    public function catalogsHeader()
    {
        return $this->catalogService->getHeader();
    }
}
