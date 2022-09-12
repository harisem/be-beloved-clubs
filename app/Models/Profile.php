<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'province_id',
        'city_id',
        'first_name',
        'last_name',
        'phone_number',
        'full_address',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['province_id', 'city_id', 'first_name', 'last_name', 'phone_number', 'full_address', 'created_at', 'updated_at'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['provinces', 'cities'];

    /**
     * Define inverse relationship to Customer's Model
     */
    public function customers()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    /**
     * Define inverse relationship to Province's Model
     */
    public function provinces()
    {
        return $this->belongsTo('App\Models\Province', 'province_id');
    }

    /**
     * Define inverse relationship to City's Model
     */
    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
}
