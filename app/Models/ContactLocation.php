<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class ContactLocation extends Model
{
    use Translatable;
    public $translatedAttributes = ['country','street','area','city'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
