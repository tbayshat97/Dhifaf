<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Governorate extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];
}
