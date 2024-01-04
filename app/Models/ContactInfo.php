<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class ContactInfo extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
