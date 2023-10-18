<?php

namespace App\Services\Points\CRSHelpers\AdditionalFactors;

use App\Services\Points\CRSHelpers\SkillsTransferability\SubsectionInterface;

class CanadianStudy extends SubsectionsPreparedHelper implements SubsectionInterface
{
    const TABLE_HEADER = ['Canadian study experience', 'Points'];
}
