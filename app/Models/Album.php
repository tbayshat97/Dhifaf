<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function getAlbumGallery()
    {

        $items = $this->gallery_image;
        $gallery = [];

        if (!is_null($items)) {
            foreach (json_decode($items) as $key => $value) {
                $gallery[] = asset('storage/' . $value->file);
            }
        }
        return $gallery;
    }

}
