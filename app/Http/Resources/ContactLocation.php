<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactLocation extends JsonResource
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
            'country' => $this->translateOrDefault()->country,
            'city' => $this->translateOrDefault()->city,
            'area' => $this->translateOrDefault()->area,
            'street' => $this->translateOrDefault()->street,
        ];
    }
}
