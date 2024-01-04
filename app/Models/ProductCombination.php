<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class ProductCombination extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['combination'];
    public $translationForeignKey = 'pc_id';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
