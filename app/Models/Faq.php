<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Faq extends Model
{
    use Translatable;
    public $translatedAttributes = ['question','answer'];
}
