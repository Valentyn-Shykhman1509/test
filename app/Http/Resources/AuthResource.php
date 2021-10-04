<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
			'last_name' => $this->last_name,
            'email' => $this->email,
			'phone' => $this->phone,
			'api_key' => $this->api_key
        ];
    }
}