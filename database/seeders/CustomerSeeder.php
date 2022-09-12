<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::create([
            'email' => 'customer1@mail.com',
            'password' => Hash::make('1customer')
        ]);

        $customer->profiles()->create([
            'first_name' => 'Customer',
            'last_name' => 'Satu',
        ]);
    }
}
