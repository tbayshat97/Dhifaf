<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class MainSlider extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = [
        'line_one',
        'line_two',
        'line_three',
        'line_four',
        'btn_text',
    ];

    // public $translatedAttributes = ['description'];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // public function images()
    // {
    //     return $this->hasMany(MainSliderImage::class);
    // }
}
