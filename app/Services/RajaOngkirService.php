<?php

namespace App\Services;

use App\Interfaces\RajaOngkirInterface;
use App\Traits\ResponseAPI;

class RajaOngkirService
{
    use ResponseAPI;

    protected $rajaOngkirInterface;

    public function __construct(RajaOngkirInterface $rajaOngkirInterface)
    {
        $this->rajaOngkirInterface = $rajaOngkirInterface;
    }

    public function findProvinces()
    {
        try {
            $data = $this->rajaOngkirInterface->getProvinces();
            return (!$data->isEmpty()) ? $this->success('List provinces', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findCities($q)
    {
        try {
            $data = $this->rajaOngkirInterface->getCities($q);
            return (!$data->isEmpty()) ? $this->success('List cities', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findOngkir($request)
    {
        try {
            $request = [
                'city_destination' => $request['city_destination'],
                'weight' => $request['weight'],
                'courier' => $request['courier'],
            ];
            $data = $this->rajaOngkirInterface->getOngkir($request);
            return isset($data) ? $this->success($request['courier'] . '\'s cost', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}