<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InfluencerProfile extends Model
{
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = ['birthdate' => 'datetime'];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }


    public function getProfileImage()
    {
        $image = null;

        if ($this->image) {
            foreach (json_decode($this->image) as $value) {
                $image = asset('storage/' . $value->file);
            }
        }

        return $image;
    }

    public function getProfileHeader()
    {
        $header = null;

        if ($this->header) {
            foreach (json_decode($this->header) as $value) {
                $header = asset('storage/' . $value->file);
            }
        }

        return $header;
    }

    public function getProfileGallery()
    {
        $items = $this->gallery;

        if (!is_null($items)) {
            foreach (json_decode($items) as $value) {
                $gallery[] = asset('storage/' . $value->file);
            }
        }

        return $gallery;
    }
}
