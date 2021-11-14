<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'size',
        'color',
        'frontImg',
        'backImg',
        'weight',
        'ready',
    ];

    /**
     * Define inverse relationship to Product's Model
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
