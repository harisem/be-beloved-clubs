<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'link',
    ];

    /**
     * Get image function
     * 
     * @param mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/sliders/' . $image);
    }
}
