<?php

namespace App\Services\MergeHelpers;

use Arr;

class ExpressEntry extends BaseHelper
{
    public function handle()
    {
        return [
            'existing_profile' => Arr::get($this->virtualProfile->user, 'express.existing_profile'),
            'invitation_received' => Arr::get($this->virtualProfile->user, 'express.invitation_received'),
        ];
    }
}
