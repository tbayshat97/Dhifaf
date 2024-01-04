<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Size extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];
}
