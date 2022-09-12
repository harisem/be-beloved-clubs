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
        'warehouse_id',
        'quantity',
        'price',
        'weight',
    ];

    /**
     * Define inverse relationship to Customer's Model
     */
    public function customers()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    /**
     * Define inverse relationship to Warehouse's Model
     */
    public function warehouses()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_id');
    }
}
