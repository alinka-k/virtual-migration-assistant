<?php

namespace App\Services\Points\Programs\Helpers;

use Arr;

class NetWorthHelper
{
    const REQUIRED_FUNDS = [
        0 => 0,
        1 => 12960,
        2 => 16135,
        3 => 19836,
        4 => 24083,
        5 => 27315,
        6 => 30806,
        7 => 34299
    ];

    public static function isNetWorthForFamilyValid(array $payload = []): bool
    {
        $net_worth = Arr::get($payload, 'personal_net_worth.net_worth', 0);
        $maritalStatus = Arr::get($payload, 'profile.marital_status', '');
        $married = (empty($maritalStatus) || $maritalStatus === 'single') ? 0 : 1;
        $family = (int) Arr::get($payload, 'profile.children_0_12', 0) + (int) Arr::get($payload, 'profile.children_13_18', 0) + $married + 1;
        if ($family > 7) {
            return $net_worth > (self::REQUIRED_FUNDS[7] + ($family - 7) * 3492);
        }

        return $net_worth > self::REQUIRED_FUNDS[$family];
    }
}
