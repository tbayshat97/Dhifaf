<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class ProductVariationItem extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];
    public $translationForeignKey = 'pvi_id';

    public function productVariation()
    {
        return $this->belongsTo(Product::class, 'pv_id');
    }
}
