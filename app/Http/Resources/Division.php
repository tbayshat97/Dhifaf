<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Division extends JsonResource
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
            'division_id' => $this->id,
            'division_image' => ((!is_null($this->image)) ? asset('storage/' . $this->image) : 'https://via.placeholder.com/512/?text=Dhifaf'),
            'division_header' => ((!is_null($this->header)) ? asset('storage/' . $this->header) : 'https://via.placeholder.com/1920x500/?text=Dhifaf'),
            'division_name' => $this->translateOrDefault()->name,
            'division_slug' => $this->translateOrDefault()->slug,
            'division_description' => $this->translateOrDefault()->description,
            'division_banner' => DivisionBanner::make($this->banner),
            'division_categories' => Category::collection($this->categories())
        ];
    }
}
