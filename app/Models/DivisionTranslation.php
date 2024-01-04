<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class DivisionTranslation extends Model
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

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
