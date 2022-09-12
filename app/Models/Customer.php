<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'email',
        'password'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['email', 'email_verified_at', 'created_at', 'updated_at'];

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
     * The relationships that should always be loaded.
     *
     * @var array
     */
    // protected $with = ['profiles'];

    /**
     * Define relationship to Profile's Model
     */
    public function profiles()
    {
        return $this->hasOne('App\Models\Profile');
    }

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
