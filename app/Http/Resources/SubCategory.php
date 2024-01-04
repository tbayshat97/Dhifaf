<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategory extends JsonResource
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
            'sub_category_id' => $this->id,
            'sub_category_image' => ((!is_null($this->image)) ? asset('storage/' . $this->image) : 'https://via.placeholder.com/512/?text=Dhifaf'),
            'sub_category_name' => $this->translateOrDefault()->name,
        ];
    }
}
