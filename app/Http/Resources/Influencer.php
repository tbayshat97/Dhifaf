<?php

namespace App\Http\Resources;

use App\Http\Resources\Product as ResourcesProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class Influencer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'influencer_id' => $this->id,
            'influencer_username' => $this->username,
            'influencer_slug' => $this->translateOrDefault()->slug,
            'influencer_created_at' => $this->created_at->diffforhumans(),
            'influencer_profile' => InfluencerProfile::make($this->profile),
            'influencer_products' => ResourcesProduct::collection($this->products())
        ];
    }
}
