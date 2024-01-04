<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class BrandAbout extends Model
{
    use Translatable;
    public $translatedAttributes = ['description', 'title'];
}
