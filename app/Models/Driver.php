<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    public function getFullnameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function profile()
    {
        return $this->hasOne(DriverProfile::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
