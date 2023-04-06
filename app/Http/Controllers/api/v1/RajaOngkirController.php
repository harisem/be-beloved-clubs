<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }
    public function provinces()
    {
        return $this->rajaOngkirService->findProvinces();
    }

    public function cities(Request $request)
    {
        return $this->rajaOngkirService->findCities($request->q);
    }

    public function ongkir(Request $request)
    {
        return $this->rajaOngkirService->findOngkir($request->only(['city_destination', 'weight', 'courier']));
    }
}
