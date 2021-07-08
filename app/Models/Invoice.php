<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice',
        'customer_id',
        'courier',
        'service',
        'cost_courier',
        'weight',
        'name',
        'phone',
        'province',
        'city',
        'address',
        'status',
        'grand_total',
        'snap_token',
    ];

    /**
     * Define relationship to Order's Model
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Define inverse relationship to Customer's Model
     */
    public function customers()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
