<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Gallery extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];

    public function getGalleryImage()
    {
        $image = null;

        if ($this->image) {
            foreach (json_decode($this->image) as $value) {
                $image = asset('storage/' . $value->file);
            }
        }
        return $image;
    }

    public function album()
    {
        return $this->hasOne(Album::class);
    }

}
