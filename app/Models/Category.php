<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public function sub()
    {
        return $this->hasMany(SubCategory::class)->where('is_active', true);
    }

    public function divisons()
    {
        return $this->hasMany(CategoryDivision::class);
    }
}
