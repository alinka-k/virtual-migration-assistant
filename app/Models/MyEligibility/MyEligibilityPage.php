<?php

namespace App\Models\MyEligibility;

use App\Enums\ImmigrationScoreType;

class MyEligibilityPage
{
    private ?FSWPPage $FSWP;
    private ?CECContent $CEC;
    private ?FSTPContent $FSTP;
    private GeneralMessage $generalMessage;

    public function __construct(
        GeneralMessage $generalMessage,
        FSWPPage $FSWP=null,
        CECContent $CEC=null,
        FSTPContent $FSTP=null
    ) {
        $this->FSWP = $FSWP;
        $this->CEC = $CEC;
        $this->FSTP = $FSTP;
        $this->generalMessage = $generalMessage;
    }

    public function getFSWP(): ?FSWPPage
    {
        return $this->FSWP;
    }

    public function getCEC(): ?CECContent
    {
        return $this->CEC;
    }

    public function getFSTP(): ?FSTPContent
    {
        return $this->FSTP;
    }

    public function getGeneralMessage(): GeneralMessage
    {
        return $this->generalMessage;
    }

    public function setProgram($program): void
    {
        if ($program->getType() === ImmigrationScoreType::CEC) {
            $this->CEC = $program;
        }
        if ($program->getType() === ImmigrationScoreType::FSW
            || $program->getType() === ImmigrationScoreType::CRS
        ) {
            $this->FSWP = $program;
        }
        if ($program->getType() === ImmigrationScoreType::FSTP) {
            $this->FSTP = $program;
        }
    }
}
