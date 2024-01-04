<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddress extends JsonResource
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
            'name' => $this->name,
            'city_id' => City::make($this->city),
            'area_id' => Area::make($this->area),
            'governorate_id' => Governorate::make($this->governorate),
            'mahala' => $this->mahala,
            'zoqaq' => $this->zoqaq,
            'dar' => $this->dar,
            'phone_number' => $this->phone_number,
            'is_active' => $this->is_active,
        ];
    }
}
