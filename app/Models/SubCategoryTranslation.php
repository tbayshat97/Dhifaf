<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SubCategoryTranslation extends Model
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

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
