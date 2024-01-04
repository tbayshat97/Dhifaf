<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Customer extends Authenticatable
{
    use Notifiable, HasMultiAuthApiTokens;

    protected $fillable = ['username', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['account_verified_at' => 'datetime'];

    public function profile()
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function findForPassport($username)
    {
        return $this->where([
            ['username', '=', $username],
            ['account_verified_at', '!=', null],
        ])->first();
    }

    public function customerNotifications()
    {
        return $this->hasMany(CustomerNotification::class)->where('is_deleted', false)->orderBy('created_at', 'desc');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function socials()
    {
        return $this->hasMany(CustomerProvider::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where(['reviewable_type' => Product::class]);
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function defaultCustomerAddress()
    {
        return $this->hasOne(CustomerAddress::class)->where('is_active', true);
    }
}
