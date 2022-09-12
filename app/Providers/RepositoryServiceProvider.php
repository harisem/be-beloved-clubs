<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\ProductInterface',
            'App\Repositories\ProductRepository'
        );

        $this->app->bind(
            'App\Interfaces\CustomerInterface',
            'App\Repositories\CustomerRepository'
        );

        $this->app->bind(
            'App\Interfaces\CartInterface',
            'App\Repositories\CartRepository'
        );

        $this->app->bind(
            'App\Interfaces\CatalogInterface',
            'App\Repositories\CatalogRepository'
        );

        $this->app->bind(
            'App\Interfaces\RajaOngkirInterface',
            'App\Repositories\RajaOngkirRepository'
        );

        $this->app->bind(
            'App\Interfaces\OrderInterface',
            'App\Repositories\OrderRepository'
        );

        $this->app->bind(
            'App\Interfaces\WarehouseInterface',
            'App\Repositories\WarehouseRepository'
        );

        $this->app->bind(
            'App\Interfaces\ProfileInterface',
            'App\Repositories\ProfileRepository'
        );

        $this->app->bind(
            'App\Interfaces\InvoiceInterface',
            'App\Repositories\InvoiceRepository'
        );
    }
}