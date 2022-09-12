<?php

namespace App\Interfaces;

interface ProfileInterface
{
    public function getProfile($customer_id);
    public function updateProfile($request, $customer_id);
}