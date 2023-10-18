<?php

namespace App\Services\MergeHelpers;

use Arr;

class PrincipalApplicant extends BaseHelper
{
    public function handle()
    {
        return [
            'first_name' => Arr::get($this->virtualProfile->user, 'first_name'),
            'last_name' => Arr::get($this->virtualProfile->user, 'last_name'),
            'email' => Arr::get($this->virtualProfile->user, 'email'),
            'phone' => Arr::get($this->virtualProfile->user, 'phone'),
        ];
    }
}
