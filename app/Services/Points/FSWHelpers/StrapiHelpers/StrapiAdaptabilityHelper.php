<?php

namespace App\Services\Points\FSWHelpers\StrapiHelpers;

class StrapiAdaptabilityHelper
{
    public static function checkRule(array $rules, array $fswScore, array $score_keys): string
    {
        if ((int) $fswScore[$score_keys['adaptability']] === 10) {
            return $rules['rule_1'];
        }

        if ((int) $fswScore[$score_keys['adaptability']] === 5) {
            return $rules['rule_2'];
        }

        return $rules['rule_3'];
    }
}
