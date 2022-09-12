<?php

namespace App\Repositories;

use App\Interfaces\ProfileInterface;
use App\Models\City;
use App\Models\Profile;
use App\Models\Province;

class ProfileRepository implements ProfileInterface
{
    public function getProfile($customer_id)
    {
        $profile = Profile::with(['provinces', 'cities'])->where('customer_id', $customer_id)->first();
        $data = [
            'first_name' => $profile->first_name,
            'last_name' => $profile->last_name,
            'phone_number' => $profile->phone_number,
            'full_address' => $profile->full_address,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
            'provinces' => $profile->provinces,
            'cities' => $profile->cities,
        ];
        return $data;
    }

    public function updateProfile($request, $customer_id)
    {
        $profile = Profile::findOrFail($customer_id);
        $profile->first_name = $request['first_name'];
        $profile->last_name = $request['last_name'];
        $profile->phone_number = $request['phone_number'];
        $profile->full_address = $request['full_address'];

        if ($request['province_id'] !== 0) {
            $province = Province::find($request['province_id']);
            $profile->provinces()->associate($province);
        }

        if ($request['city_id'] !== 0) {
            $city = City::find($request['city_id']);
            $profile->cities()->associate($city);
        }

        $profile->save();
        return true;
    }
}