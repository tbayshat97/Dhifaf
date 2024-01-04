<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class DivisionBanner extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
