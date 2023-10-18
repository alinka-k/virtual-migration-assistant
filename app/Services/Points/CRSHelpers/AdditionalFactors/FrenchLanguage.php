<?php

namespace App\Services\Points\CRSHelpers\AdditionalFactors;

use App\Services\Points\CRSHelpers\SkillsTransferability\SubsectionInterface;
use Arr;

class FrenchLanguage extends SubsectionsPreparedHelper implements SubsectionInterface
{
    const TABLE_HEADER = ['Canadian study experience', 'Points'];

    public function __construct(array $data)
    {
        $this->factors = Arr::get($data, 'factors', []);
    }
}
