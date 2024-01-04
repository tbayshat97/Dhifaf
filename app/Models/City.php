<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class City extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
    public  function areas()
    {
        return $this->hasMany(Area::class);
    }
}
