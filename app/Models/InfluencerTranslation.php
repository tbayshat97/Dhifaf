<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class InfluencerTranslation extends Model
{
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'id'],
            ]
        ];
    }

    public function influencer()
    {
        return $this->belongsTo(Influencer::class);
    }
}
