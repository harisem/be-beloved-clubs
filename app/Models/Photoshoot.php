<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photoshoot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'catalog_id',
        'image',
    ];

    /**
     * Get image function
     * 
     * @param mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/photoshoots/' . $image);
    }

    /**
     * Define relationship to Catalog's Model
     */
    public function catalogs()
    {
        return $this->belongsTo('App\Models\Catalog');
    }
}
