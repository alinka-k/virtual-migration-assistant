<?php

namespace App\Http\Resources\MyEligibility;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'message' => $this->getMessage(),
            'bubble' => $this->getBubble(),
        ];
    }
}
