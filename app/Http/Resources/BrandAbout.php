<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandAbout extends JsonResource
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
          'id' => $this->id,
          'big_image' => ($this->big_image) ? asset('storage/' . $this->big_image) : null,
          'small_image' => ($this->small_image) ? asset('storage/' . $this->small_image) : null,
          'title' => $this->translateOrDefault()->title,
          'description' => $this->translateOrDefault()->description,
        ];
    }
}
