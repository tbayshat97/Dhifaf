<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDivision extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
