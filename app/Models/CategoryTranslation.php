<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class CategoryTranslation extends Model
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
