<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'catalog_id',
        'name',
        'slug',
        'image',
        'content',
        'weight',
        'price',
        'stock',
        'discount',
    ];

    /**
     * Get image function
     * 
     * @param mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/products/' . $image);
    }

    /**
     * Define inverse relationship to Catalog's Model
     */
    public function catalogs()
    {
        return $this->belongsTo('App\Models\Catalog', 'catalog_id');
    }

    /**
     * Define relationship to Cart's Model
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    /**
     * Define relationship to Order's Model
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Define relationship to Warehouse's Model
     */
    public function warehouses()
    {
        return $this->hasMany('App\Models\Warehouse');
    }
}
