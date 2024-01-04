<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'content' => $this->translateOrDefault()->content,
            'contact_locations' => ContactLocation::collection($this->contactLocations),
            'contact_infos' => ContactInfo::collection($this->contactinfos),
            'contact_emails' => ContactEmail::collection($this->contactEmails),
        ];
    }
}
