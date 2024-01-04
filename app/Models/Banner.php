<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Banner extends Model
{
    use Translatable;
    protected $guarded=[];
    public $translatedAttributes = ['name'];
}
