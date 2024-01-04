<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandSlider extends JsonResource
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
            'image' => ($this->image) ? asset('storage/' . $this->image) : null,
            'logo' => ($this->logo) ? asset('storage/' . $this->logo) : null,
            'title' => $this->translateOrDefault()->title,
            'content' => $this->translateOrDefault()->content,
            'btn_text' => $this->translateOrDefault()->btn_text,
            'btn_link' => $this->btn_link,
        ];
    }
}
