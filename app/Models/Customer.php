<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Define relationship to Cart's Model
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    /**
     * Define relationship to Invoice's Model
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }
}
