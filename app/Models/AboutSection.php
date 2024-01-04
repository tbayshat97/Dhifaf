<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class AboutSection extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];
}
