<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'image',
        'slug',
    ];

    /**
     * Get image function
     * 
     * @param mixed $image
     * @return void
     */
    public function getImageAttributes($image)
    {
        return asset('storage/catalogs/' . $image);
    }

    /**
     * Define relationship to Photoshoot's Model
     */
    public function photoshoots()
    {
        return $this->hasMany('App\Models\Photoshoot');
    }

    /**
     * Define relationship to Product's Model
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
