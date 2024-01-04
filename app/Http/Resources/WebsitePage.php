<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebsitePage extends JsonResource
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
            'title' => $this->translateOrDefault()->title,
            'content' => $this->translateOrDefault()->content,
            'slug' => $this->translateOrDefault()->slug,
        ];
    }
}
