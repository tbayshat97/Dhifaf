<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LuxuryBrand extends JsonResource
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
            'brand_image' => asset('storage/' . $this->image),
            'brand_header' => asset('storage/' . $this->header),
            'brand_name' => $this->translateOrDefault()->name,
            'brand_slug' => $this->translateOrDefault()->slug,
            'brand_category' => Category::collection($this->categories()),
            'brand_product' => Product::collection($this->products),
            'brand_about' => BrandAbout::make($this->about),
            'brand_banner' => Banner::make($this->banner),
            'brand_slider' => BrandSlider::collection($this->brandSliders),
            'brand_new_arrivals' => Product::collection($this->newArrivals()),
            'brand_best_seller' => Product::collection($this->bestSeller())
        ];
    }
}
