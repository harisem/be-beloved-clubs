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
        'warehouse_id',
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
        return $this->belongsTo('App\Models\Invoice', 'invoice_id');
    }

    /**
     * Define inverse relationship to Warehouse's Model
     */
    public function warehouses()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_id');
    }
}
