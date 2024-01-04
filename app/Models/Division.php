<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Division extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name', 'description', 'slug'];

    public function categories()
    {
        $categories =  $this->hasMany(CategoryDivision::class)->pluck('category_id')->toArray();

        return Category::whereIn('id', $categories)->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function banner()
    {
        return $this->hasOne(DivisionBanner::class);
    }
}
