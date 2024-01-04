<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Astrotomic\Translatable\Translatable;

class Influencer  extends Authenticatable
{
    use Notifiable, HasMultiAuthApiTokens, Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name', 'bio'];
    protected $hidden = ['password', 'remember_token'];
    protected $guard = 'artist';

    public function profile()
    {
        return $this->hasOne(InfluencerProfile::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favourable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function products()
    {
        $productIds = $this->hasMany(InfluencerProduct::class)->pluck('product_id')->toArray();

        return Product::whereIn('id', $productIds)->get();
    }
}
