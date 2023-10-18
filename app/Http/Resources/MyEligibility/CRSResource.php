<?php

namespace App\Http\Resources\MyEligibility;

use Illuminate\Http\Resources\Json\JsonResource;

class CRSResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getType(),
            'currentScore' => $this->getCurrentScore(),
            'scoreBubble' => $this->getScoreBubble(),
            'sections' => $this->getSections(),
            'programDescription' => $this->getProgramDescription(),
            'programRequirements' => $this->getProgramRequirements(),
            'breakdown' => $this->getBreakdown(),
            'benefits' => $this->getBenefits(),
        ];
    }
}
