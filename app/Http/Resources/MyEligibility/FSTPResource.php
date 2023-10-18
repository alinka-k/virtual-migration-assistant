<?php

namespace App\Http\Resources\MyEligibility;

use Illuminate\Http\Resources\Json\JsonResource;

class FSTPResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'mainText' => $this->getMainText(),
            'programDescription' => $this->getProgramDescription(),
            'programRequirements' => $this->getProgramRequirements(),
            'sections' => $this->getSections(),
        ];
    }
}
