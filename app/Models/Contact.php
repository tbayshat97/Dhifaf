<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Contact extends Model
{
    use Translatable;
    public $translatedAttributes = ['content'];

    public function contactLocations()
    {
        return $this->hasMany(ContactLocation::class);
    }

    public function contactInfos()
    {
        return $this->hasMany(ContactInfo::class);
    }

    public function contactEmails()
    {
        return $this->hasMany(ContactEmail::class);
    }
}
