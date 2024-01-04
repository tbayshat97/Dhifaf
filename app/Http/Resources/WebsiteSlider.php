<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteSlider extends JsonResource
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
            'website_slider_id' => $this->id,
            'website_slider_image' => asset('storage/' . $this->image),
            'website_slider_title' => $this->translateOrDefault()->title,
            'website_slider_content' => $this->translateOrDefault()->content,
            'website_slider_action' => $this->translateOrDefault()->action,
            'website_slider_url' => $this->url,
            'website_slider_images' => WebsiteSliderImage::collection($this->images)
        ];
    }
}
