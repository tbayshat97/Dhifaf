<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainSlider extends JsonResource
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
            'main_slider_id' => $this->id,
            'main_slider_image' => asset('storage/' . $this->image),
            'main_slider_line_one' => $this->translateOrDefault()->line_one,
            'main_slider_line_two' => $this->translateOrDefault()->line_two,
            'main_slider_line_three' => $this->translateOrDefault()->line_three,
            'main_slider_line_four' => $this->translateOrDefault()->line_four,
            'main_slider_btn_text' => $this->translateOrDefault()->btn_text,
            'main_slider_btn_link' => $this->btn_link,
        ];
    }
}
