<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'category_id' => $this->id,
            'category_sub' => SubCategory::collection($this->sub),
            'category_image' => ((!is_null($this->image)) ? asset('storage/' . $this->image) : 'https://via.placeholder.com/512/?text=Dhifaf'),
            'category_header' => ((!is_null($this->header)) ? asset('storage/' . $this->header) : 'https://via.placeholder.com/1920x500/?text=Dhifaf'),
            'category_name' => $this->translateOrDefault()->name,
            'category_slug' => $this->translateOrDefault()->slug,
        ];
    }
}
