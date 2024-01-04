<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
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
            'review_id' => $this->id,
            'customer' => CustomerProfile::make($this->customer->profile),
            'review_rate' => $this->rate,
            'review_note' => $this->note,
            'review_created_at' => $this->created_at->diffforhumans(),
        ];
    }
}
