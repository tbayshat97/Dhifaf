<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainSliderImage extends Model
{

    public function mainSlider()
    {
        return $this->belongsTo(MainSlider::class);
    }
}
