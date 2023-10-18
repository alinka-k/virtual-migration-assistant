<?php

namespace App\Services\Points\FSWHelpers\StrapiHelpers;

use App\Models\User;

class StrapiAgeHelper
{
    public static function checkRule(array $rules, User $user): string
    {
        $age = $user->profile->getAgeAttribute();

        if ($age < 18) {
            return $rules['rule_1'];
        }

        if ($age < 36) {
            return $rules['rule_2'];
        }

        return $rules['rule_3'];
    }
}
