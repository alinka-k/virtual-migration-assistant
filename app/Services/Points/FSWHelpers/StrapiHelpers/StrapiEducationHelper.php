<?php

namespace App\Services\Points\FSWHelpers\StrapiHelpers;

class StrapiEducationHelper
{
    public static function checkRule(array $rules, array $fswScore, array $score_keys): string
    {
        if ($fswScore[$score_keys['education']] >= 21) {
            return $rules['rule_1'];
        }

        if ((int) $fswScore[$score_keys['education']] === 19) {
            return $rules['rule_2'];
        }

        if ((int) $fswScore[$score_keys['education']] === 15) {
            return $rules['rule_3'];
        }

        if ((int) $fswScore[$score_keys['education']] === 5) {
            return $rules['rule_4'];
        }

        return '';
    }
}
