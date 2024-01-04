<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    protected $casts = ['birthdate' => 'datetime'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
