<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'product_id',
        'image',
        'quantity',
        'price',
        'status',
    ];

    /**
     * Define inverse relationship to Invoice's Model
     */
    public function invoices()
    {
        return $this->belongsTo('App\Models\Invoice');
    }

    /**
     * Define inverse relationship to Product's Model
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}