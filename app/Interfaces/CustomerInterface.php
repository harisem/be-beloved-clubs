<?php

namespace App\Interfaces;

interface CustomerInterface
{
    public function getCustomers($query);
    public function getCustomerById($id);
}