<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanadianRelativeItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'relationship' => $this->relationship,
            'canadian_status' => $this->canadian_status,
            'province' => $this->province,
            'residency_duration' => $this->residency_duration,
        ];
    }
}
