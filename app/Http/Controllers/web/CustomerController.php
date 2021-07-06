<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->when(request()->query, function ($customers) {
            $customers = $customers->where('name', 'like', '%' . request()->query . '%');
        })->paginate(10);

        return view('customers.index', [
            'customers' => $customers
        ]);
    }
}
