<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerInterface
{
    public function getCustomers($query)
    {
        $customers = Customer::when($query, function ($customers) use ($query) {
            $customers = $customers->where('name', 'like', '%' . $query . '%');
        })->paginate(10);

        return $customers;
    }

    public function getCustomerById($id)
    {
        $customer = Customer::findOrFail($id);
        return $customer;
    }
}