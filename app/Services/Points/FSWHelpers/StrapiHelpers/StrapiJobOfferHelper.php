<?php

namespace App\Services\Points\FSWHelpers\StrapiHelpers;

class StrapiJobOfferHelper
{
    public static function checkRule(array $rules, array $fswScore, array $score_keys): string
    {
        if ((int) $fswScore[$score_keys['jobOffer']] === 10) {
            return $rules['rule_1'];
        }

        return $rules['rule_2'];
    }
}
