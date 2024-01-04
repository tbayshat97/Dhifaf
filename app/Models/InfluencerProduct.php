<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfluencerProduct extends Model
{
    public function influencer()
    {
        return $this->belongsTo(Influencer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
