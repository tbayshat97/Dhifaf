<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Brand extends JsonResource
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
            'brand_id' => $this->id,
            'brand_url' => url('brands/' . $this->slug),
            'brand_image' => ((!is_null($this->image)) ? asset('storage/' . $this->image) : 'https://via.placeholder.com/512/?text=Dhifaf'),
            'brand_header' => ((!is_null($this->header)) ? asset('storage/' . $this->header) : 'https://via.placeholder.com/1920x500/?text=Dhifaf'),
            'brand_name' => $this->translateOrDefault()->name,
            'brand_slug' => $this->translateOrDefault()->slug,
        ];
    }
}
