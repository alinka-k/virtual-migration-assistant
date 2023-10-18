<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use Arr;

class MoneyHelper
{
    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        return [
            'title' => 'How much money do I need to prove that I can settle in Canada?',
            'noMax' => true,
            'subsections' => [
                [
                    'html' => Arr::get($strapiData, 'money.rule_0', ''),
                ]
            ]
        ];
    }
}
