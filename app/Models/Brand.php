<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Astrotomic\Translatable\Translatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Brand extends Authenticatable implements TranslatableContract
{
    use Notifiable, HasMultiAuthApiTokens, Translatable, HasRoles;

    public $translatedAttributes = ['name'];
    protected $hidden = ['password'];
    protected $guard = 'brand';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function findForPassport($username)
    {
        return $this->where([
            ['username', '=', $username],
        ])->first();
    }

    public function categories()
    {
        $categories = $this->hasMany(BrandCategory::class)->pluck('category_id')->toArray();

        return Category::whereIn('id', array_unique($categories))->get();
    }

    public function brandSliders()
    {
        return $this->hasMany(BrandSlider::class);
    }

    public function banner()
    {
        return $this->hasOne(BrandBanner::class);
    }

    public function about()
    {
        return $this->hasOne(BrandAbout::class);
    }

    public function newArrivals()
    {
        return Product::where('brand_id', $this->id)->where('new_arrival', true)->take(6)->get();
    }

    public function bestSeller()
    {
        return Product::where('brand_id', $this->id)->where('best_sellers', true)->take(6)->get();
    }

    public function childs()
    {
        return $this->hasMany(Brand::class, 'parent_brand_id', 'id');
    }
}
