<?php

namespace App\Services\Points\CRSHelpers\SkillsTransferability;

class NonCanadianWorkExperience extends SubsectionsPreparedHelper implements SubsectionInterface
{
    const SUBSECTIONS = [
        'Non-Canadian work experience with Canadian work experience' => ['Work Experience', '+ 1 year of Canadian Work', '+ 2 year of Canadian Work'],
        'Non-Canadian work experience with Language' => ['Work Experience', '+ CLB 7 or 8', '+ CLB 9 or Higher'],
    ];
}
