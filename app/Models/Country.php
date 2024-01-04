<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Country extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public  function cities()
    {
        return $this->hasMany(City::class);
    }
}
