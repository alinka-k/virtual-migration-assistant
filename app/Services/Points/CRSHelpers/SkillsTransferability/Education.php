<?php

namespace App\Services\Points\CRSHelpers\SkillsTransferability;

class Education extends SubsectionsPreparedHelper implements SubsectionInterface
{
    const SUBSECTIONS = [
        'Education with Canadian work experience' => ['Level of education', '+ 1 year of Canadian Work', '+ 2 year of Canadian Work'],
        'Education with Language' => ['Level of education', '+ CLB 7 or 8', '+ CLB 9 or Higher'],
    ];
}
