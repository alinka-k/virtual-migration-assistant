<?php

namespace App\Services\MergeHelpers;

use App\Http\Resources\Evaluate\CanadianRelativesItem;
use Arr;

class Relatives extends BaseHelper
{
    public function handle()
    {
        $relatives = CanadianRelativesItem::collection(Arr::get($this->virtualProfile, 'relative.items') ?? [])->all();

        return [
            'has_friend_mb' => !empty($relatives),
            'has_relatives' => !empty($relatives),
            'relatives' => $relatives,
        ];
    }
}
