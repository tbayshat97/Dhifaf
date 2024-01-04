<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class ProductVariation extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];
    public $translationForeignKey = 'pv_id';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function items()
    {
        return $this->hasMany(ProductVariationItem::class, 'pv_id');
    }
}
