<?php

namespace App\Services\MergeHelpers;

use Arr;

class Manitoba extends BaseHelper
{
    public function handle()
    {
        return [
            'strategic_recruitment_invitation' => Arr::get($this->virtualProfile->user, 'manitoba.strategic_recruitment_invitation'),
        ];
    }
}
