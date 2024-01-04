<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Illuminate\Database\Eloquent\Model;

class BrandSlider extends Model
{
    use Translatable;
    public $translatedAttributes = [
        'title',
        'content',
        'btn_text',
        ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
