<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'read customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);
        
        Permission::create(['name' => 'read invoices']);
        Permission::create(['name' => 'update invoices']);
        Permission::create(['name' => 'delete invoices']);
        
        Permission::create(['name' => 'read orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'create catalogs']);
        Permission::create(['name' => 'read catalogs']);
        Permission::create(['name' => 'update catalogs']);
        Permission::create(['name' => 'delete catalogs']);

        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'read products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'create warehouses']);
        Permission::create(['name' => 'read warehouses']);
        Permission::create(['name' => 'update warehouses']);
        Permission::create(['name' => 'delete warehouses']);

        Permission::create(['name' => 'create sliders']);
        Permission::create(['name' => 'read sliders']);
        Permission::create(['name' => 'update sliders']);
        Permission::create(['name' => 'delete sliders']);

        $owner = Role::create(['name' => 'owner']);
        $administrator = Role::create(['name' => 'administrator']);
        $marketing = Role::create(['name' => 'marketing']);
        $production = Role::create(['name' => 'production']);

        $administrator->givePermissionTo('read customers', 'update customers', 'delete customers');
        $administrator->givePermissionTo('read invoices', 'update invoices', 'delete invoices');
        $administrator->givePermissionTo('read orders', 'update orders', 'delete orders');
        $administrator->givePermissionTo('read catalogs');
        $administrator->givePermissionTo('read products');
        $administrator->givePermissionTo('read warehouses');
        $administrator->givePermissionTo('create sliders', 'read sliders', 'update sliders', 'delete sliders');

        $marketing->givePermissionTo('read customers');
        $marketing->givePermissionTo('read invoices', 'update invoices');
        $marketing->givePermissionTo('read orders', 'update orders');
        $marketing->givePermissionTo('create catalogs', 'read catalogs', 'update catalogs', 'delete catalogs');
        $marketing->givePermissionTo('create products', 'read products', 'update products', 'delete products');
        $marketing->givePermissionTo('read warehouses');
        $marketing->givePermissionTo('create sliders', 'read sliders', 'update sliders', 'delete sliders');

        $production->givePermissionTo('read invoices');
        $production->givePermissionTo('read orders');
        $production->givePermissionTo('read catalogs');
        $production->givePermissionTo('create products', 'read products', 'update products', 'delete products');
        $production->givePermissionTo('create warehouses', 'read warehouses', 'update warehouses', 'delete warehouses');
        $production->givePermissionTo('read sliders');

        $user1 = User::create([
            'name' => 'Anangga',
            'email' => 'anangga@mail.com',
            'password' => Hash::make('kentung123')
        ]);
        $user1->assignRole($owner);

        $user2 = User::create([
            'name' => 'Reza',
            'email' => 'reza@mail.com',
            'password' => Hash::make('mauli123')
        ]);
        $user2->assignRole($administrator);

        $user3 = User::create([
            'name' => 'Haris',
            'email' => 'haris@mail.com',
            'password' => Hash::make('haris123')
        ]);
        $user3->assignRole($marketing);

        $user4 = User::create([
            'name' => 'Fauzan',
            'email' => 'fauzan@mail.com',
            'password' => Hash::make('fauzan123')
        ]);
        $user4->assignRole($production);

        $user5 = User::create([
            'name' => 'Shidqi',
            'email' => 'shidqi@mail.com',
            'password' => Hash::make('shidqi123')
        ]);
        $user5->assignRole($marketing);

        $user6 = User::create([
            'name' => 'Calfin',
            'email' => 'calfin@mail.com',
            'password' => Hash::make('calfin123')
        ]);
        $user6->assignRole($production);
    }
}
