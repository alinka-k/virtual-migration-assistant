<?php

namespace App\Services\Points\FSWHelpers\StrapiHelpers;

class StrapiLanguageHelper
{
    public static function checkRule(array $rules, array $fswScore, array $score_keys): string
    {
        if ($fswScore[$score_keys['primary']] >= 20) {
            if ($fswScore[$score_keys['secondary']] >= 4) {
                return $rules['rule_4'];
            } elseif ($fswScore[$score_keys['secondary']] == 0) {
                return $rules['rule_1'];
            }
        }

        if ($fswScore[$score_keys['primary']] >= 16) {
            if ($fswScore[$score_keys['secondary']] >= 4) {
                return $rules['rule_5'];
            } elseif ((int) $fswScore[$score_keys['primary']] === 16 && $fswScore[$score_keys['secondary']] >= 0) {
                return $rules['rule_2'];
            }
        }

        if ($fswScore[$score_keys['primary']] <= 15) {
            if ($fswScore[$score_keys['secondary']] >= 4) {
                return $rules['rule_6'];
            } elseif ((int) $fswScore[$score_keys['secondary']] === 0) {
                return $rules['rule_3'];
            }
        }
        return '';
    }
}
