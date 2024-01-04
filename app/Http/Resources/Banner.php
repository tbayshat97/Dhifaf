<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Banner extends JsonResource
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
            'banner_id' => $this->id,
            'banner_image' => asset('storage/' . $this->image),
            'banner_name' => $this->translateOrDefault()->name,
            'banner_cta' => $this->cta,
        ];
    }
}
