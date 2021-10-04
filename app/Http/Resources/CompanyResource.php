<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
			'phone' => $this->phone,
			'description' => $this->description
        ];
    }
}