<?php

namespace App\Services\Points\FSWHelpers\StrapiHelpers;

class StrapiWorkHelper
{
    public static function checkRule(array $rules, array $fswScore, array $score_keys): string
    {
        if ((int)$fswScore[$score_keys['work_experience']] === 15) {
            return $rules['rule_1'];
        }

        if ((int)$fswScore[$score_keys['work_experience']] === 13) {
            return $rules['rule_2'];
        }

        if ((int)$fswScore[$score_keys['work_experience']] === 11) {
            return $rules['rule_3'];
        }

        if ((int)$fswScore[$score_keys['work_experience']] === 9) {
            return $rules['rule_4'];
        }

        return '';
    }
}
