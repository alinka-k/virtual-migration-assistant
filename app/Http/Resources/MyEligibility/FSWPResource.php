<?php

namespace App\Http\Resources\MyEligibility;

use Illuminate\Http\Resources\Json\JsonResource;

class FSWPResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getType(),
            'mainText' => $this->getMainText(),
            'sections' => $this->getSections(),
            'programDescription' => $this->getProgramDescription(),
            'programRequirements' => $this->getProgramRequirements(),
            'currentScore' => $this->getCurrentScore(),
            'maxScore' => $this->getMaxScore(),
        ];
    }
}
