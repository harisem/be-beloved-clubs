<?php

namespace App\Services;

use App\Interfaces\ProfileInterface;
use App\Traits\ResponseAPI;

class ProfileService
{
    use ResponseAPI;

    protected $profileInterface;

    public function __construct(ProfileInterface $profileInterface)
    {
        $this->profileInterface = $profileInterface;
    }

    public function find($customer_id)
    {
        try {
            $data = $this->profileInterface->getProfile($customer_id);
            return isset($data) ? $this->success('success', $data) : $this->error('No data found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function toUpdate($request, $customer_id)
    {
        $request = [
            'province_id' => $request['province_id'] ? $request['province_id'] : 0,
            'city_id' => $request['city_id'] ? $request['city_id'] : 0,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'full_address' => $request['full_address'],
        ];
        try {
            $this->profileInterface->updateProfile($request, $customer_id);
            return $this->success('Profile\'s Updated', null);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}