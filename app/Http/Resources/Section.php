<?php

namespace App\Http\Resources;

use App\Enums\SectionType;
use Illuminate\Http\Resources\Json\JsonResource;

class Section extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $section = SectionType::fromValue($this->key);

        return [
            'section_id' => $this->id,
            'section_detail' => [
                'key' => $section->key,
                'value' => $section->value,
                'description' => $section->description,
            ],
            'section_data' => json_decode($this->translateOrDefault()->data)
        ];
    }
}
