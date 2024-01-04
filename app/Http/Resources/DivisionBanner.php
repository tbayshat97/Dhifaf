<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DivisionBanner extends JsonResource
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
            'image' => ((!is_null($this->image)) ? asset('storage/' . $this->image) : 'https://via.placeholder.com/512/?text=Dhifaf'),
            'name' => $this->translateOrDefault()->name,
            'cta' => $this->cta,
        ];
    }
}
