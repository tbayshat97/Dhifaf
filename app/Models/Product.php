<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description', 'ingredients', 'how_to_use'];

    protected $casts = [
        'sale_price_from' => 'datetime',
        'sale_price_to' => 'datetime',
        'new_from' => 'datetime',
        'new_to' => 'datetime',
    ];

    public function category()
    {
        if ($this->categories) {
            return Category::whereIn('id', json_decode($this->categories))->first();
        }

        return null;
    }

    public function categories()
    {
        if ($this->categories) {
            return Category::whereIn('id', json_decode($this->categories))->get();
        }

        return [];
    }

    public function sub_categories()
    {
        if ($this->sub_categories) {
            return SubCategory::whereIn('id', json_decode($this->sub_categories))->get();
        }

        return [];
    }

    public function sub_category()
    {
        if ($this->sub_categories) {
            return SubCategory::whereIn('id', json_decode($this->sub_categories))->first();
        }

        return null;
    }



    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sub_brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getProductImage()
    {
        $image = asset('images/product-image-placeholder.jpg');

        if ($this->image) {
            foreach (json_decode($this->image) as $value) {
                $image = asset('storage/' . $value->file);
            }
        }
        return $image;
    }

    public function getProductGallery()
    {

        $items = $this->gallery;
        $gallery = [];

        if (!is_null($items)) {
            foreach (json_decode($items) as $value) {
                $gallery[] = asset('storage/' . $value->file);
            }
        }
        return $gallery;
    }

    public function getProductSwitcher()
    {
        $switcher = asset('images/product-image-placeholder.jpg');

        if ($this->switcher) {
            foreach (json_decode($this->switcher) as $value) {
                $switcher = asset('storage/' . $value->file);
            }
        }
        return $switcher;
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function influencerProducts()
    {
        return $this->hasMany(InfluencerProduct::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function combinations()
    {
        return $this->hasMany(ProductCombination::class);
    }

    public function related()
    {
        $productsIds =  $this->hasMany(RelatedProduct::class)->pluck('related_id')->toArray();

        if (count($productsIds)) {
            return $this->whereIn('id', $productsIds)->get();
        } else {
            if ($this->categories) {
                return $this->where('id', '<>', $this->id)->whereJsonContains('categories', array_map(function ($item) {
                    return intval($item);
                }, json_decode($this->categories)))->limit(5)->inRandomOrder()->get();
            }

            return [];
        }
    }

    public function relatedIds()
    {
        return $this->hasMany(RelatedProduct::class)->pluck('related_id')->toArray();
    }

    public function group()
    {
        return $this->hasOne(ProductGroup::class);
    }

    public function groupMember()
    {
        $group = ProductGroup::whereJsonContains('product_group', [$this->id])->first();

        if ($group) {
            $ids = $group->product_group ? json_decode($group->product_group) : [];

            array_push($ids, $this->id);
            array_push($ids, $group->product_id);
            if (($key = array_search($this->id, $ids)) !== false) {
                unset($ids[$key]);
            }
            //dd($ids);
            return $this->whereIn('id', $ids)->with('translation')->get(['id', 'switcher']);
        }

        return [];
    }

    public function groupMemberMaxPrice()
    {
        $group = ProductGroup::whereJsonContains('product_group', [$this->id])->first();

        if ($group) {
            $ids = $group->product_group ? json_decode($group->product_group) : [];

            array_push($ids, $group->product_id);

            if (($key = array_search($this->id, $ids)) !== false) {
                unset($ids[$key]);
            }

            return $this->whereIn('id', $ids)->max('price');
        }

        return 0;
    }

    public function groupMemberMinPrice()
    {
        $group = ProductGroup::whereJsonContains('product_group', [$this->id])->first();

        if ($group) {
            $ids = $group->product_group ? json_decode($group->product_group) : [];

            array_push($ids, $group->product_id);

            if (($key = array_search($this->id, $ids)) !== false) {
                unset($ids[$key]);
            }

            return $this->whereIn('id', $ids)->min('price');
        }

        return 0;
    }

    public function crossSale()
    {
        $productsIds = $this->hasMany(CrossSaleProduct::class)->pluck('cross_sale_id')->toArray();

        return $this->whereIn('id', $productsIds)->get();
    }

    public function crossSaleIds()
    {
        return $this->hasMany(CrossSaleProduct::class)->pluck('cross_sale_id')->toArray();
    }

    public function upSale()
    {
        $productsIds = $this->hasMany(UpSaleProduct::class)->pluck('up_sale_id')->toArray();

        return $this->whereIn('id', $productsIds)->get();
    }

    public function upSaleIds()
    {
        return $this->hasMany(UpSaleProduct::class)->pluck('up_sale_id')->toArray();
    }
}
