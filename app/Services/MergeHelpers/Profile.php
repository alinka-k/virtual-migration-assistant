<?php

namespace App\Services\MergeHelpers;

use Arr;

class Profile extends BaseHelper
{
    public function handle()
    {
        return [
            'age' => Arr::get($this->virtualProfile->user, 'profile.age'),
            'marital_status' => Arr::get($this->virtualProfile->user, 'profile.marital_status'),
            'residence_country' => Arr::get($this->virtualProfile->user, 'profile.residence_country'),
            'destination_province' => Arr::get($this->virtualProfile->user, 'profile.destination_province'),
            'has_children' => Arr::get($this->virtualProfile->user, 'profile.has_children'),
            'children_0_12' => Arr::get($this->virtualProfile->user, 'profile.children_0_12'),
            'children_13_18' => Arr::get($this->virtualProfile->user, 'profile.children_13_18'),
        ];
    }
}
