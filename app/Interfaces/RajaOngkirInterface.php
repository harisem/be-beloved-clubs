<?php

namespace App\Interfaces;

interface RajaOngkirInterface
{
    public function getProvinces();
    public function getCities($q);
    public function getOngkir($request);
}