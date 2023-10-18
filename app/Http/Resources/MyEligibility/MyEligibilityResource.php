<?php

namespace App\Http\Resources\MyEligibility;

use App\Enums\ImmigrationScoreType;
use Illuminate\Http\Resources\Json\JsonResource;

class MyEligibilityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'generalMessage' => new GeneralMessageResource($this->getGeneralMessage()),
            'FSWP' => $this->checkFSWP(),
            'CEC' => new CECResource($this->getCEC()),
            'FSTP' => new FSTPResource($this->getFSTP()),
        ];
    }

    private function checkFSWP()
    {
        if ($this->getFSWP()) {
            return $this->getFSWP()->getType() === ImmigrationScoreType::FSW
                ? new FSWPResource($this->getFSWP())
                : new CRSResource($this->getFSWP());
        }
        return null;
    }
}
