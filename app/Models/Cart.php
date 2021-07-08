<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'price',
        'weight',
    ];

    /**
     * Define inverse relationship to Customer's Model
     */
    public function customers()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * Define inverse relationship to Product's Model
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
