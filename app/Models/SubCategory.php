<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class SubCategory extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name'];
    public $translationForeignKey = 'sc_id';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
