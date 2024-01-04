<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Section extends Model
{
    use Translatable;
    public $translatedAttributes = ['data'];
}
