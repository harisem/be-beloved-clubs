<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'city_id',
        'name',
    ];

    /**
     * Define relationship to Profile's Model
     */
    public function profiles()
    {
        return $this->hasMany('App\Models\Profile');
    }
}
