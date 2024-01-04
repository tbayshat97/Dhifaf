<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $socials = $this->socials->map(function ($item) {
            return $item->provider;
        });

        return [
            'customer_id' => $this->id,
            'customer_username' => $this->username,
            'customer_email' => $this->email,
            'customer_created_at' => $this->created_at->diffforhumans(),
            'customer_is_receive_notification' => $this->fcm_token ? true : false,
            'customer_profile' => CustomerProfile::make($this->profile),
            'customer_social' => $socials,
            'customer_address' => $this->defaultCustomerAddress ? CustomerAddress::make($this->defaultCustomerAddress) : null
        ];
    }
}
