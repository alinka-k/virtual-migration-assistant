<?php

namespace App\Http\Resources\MyEligibility;

use Illuminate\Http\Resources\Json\JsonResource;

class CECResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'benefits' => $this->getBenefits(),
            'mainText' => $this->getMainText(),
            'programDescription' => $this->getProgramDescription(),
            'programRequirements' => $this->getProgramRequirements(),
            'sections' => $this->getSections(),
        ];
    }
}
