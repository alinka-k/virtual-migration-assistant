<?php

namespace App\Services\MergeHelpers;

use Arr;

class PersonalNetWorth extends BaseHelper
{
    public function handle()
    {
        $netWorth = Arr::get($this->virtualProfile->user, 'netWorth.net_worth');
        if ($virtualNetWorth = Arr::get($this->virtualProfile, 'entrepreneurship.net_worth')) {
            $netWorth = $virtualNetWorth;
        }

        return [
            'net_worth' => asNumber($netWorth),
        ];
    }
}
