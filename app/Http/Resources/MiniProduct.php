<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MiniProduct extends JsonResource
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
            'product_id' => $this->id,
            'product_brand' => Brand::make($this->brand),
            'product_name' => $this->translateOrDefault()->title,
            'product_description' => $this->translateOrDefault()->description,
            'product_ingredients' => $this->translateOrDefault()->ingredients,
            'product_how_to_use' => $this->translateOrDefault()->how_to_use,
            'product_image' => $this->getProductImage(),
        ];
    }
}
