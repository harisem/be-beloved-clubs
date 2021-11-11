<?php

namespace App\Repositories;

use App\Interfaces\RajaOngkirInterface;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirRepository implements RajaOngkirInterface
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return $provinces;
    }

    public function getCities($q)
    {
        $cities = City::where('province_id', $q)->get();
        return $cities;
    }

    public function getOngkir($request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 106,
            'destination' => $request['city_destination'],
            'weight' => $request['weight'],
            'courier' => $request['courier']
        ])->get();
        return $cost;
    }
}