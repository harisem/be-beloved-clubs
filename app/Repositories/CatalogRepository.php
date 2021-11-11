<?php

namespace App\Repositories;

use App\Interfaces\CatalogInterface;
use App\Models\Catalog;

class CatalogRepository implements CatalogInterface
{
    public function getAll()
    {
        $catalogs = Catalog::latest()->get();
        return $catalogs;
    }

    public function getOne($slug)
    {
        $catalog = Catalog::with(['products', 'photoshoots'])->where('slug', $slug)->first();
        return $catalog;
    }

    public function getHeader()
    {
        $catalogs = Catalog::latest()->take(5)->get();
        return $catalogs;
    }
}