<?php

namespace App\Services\MergeHelpers;

use Arr;

class Comments extends BaseHelper
{
    public function handle()
    {
        return [
            'has_comments' => Arr::get($this->virtualProfile->user, 'comment.has_comments'),
            'comments' => Arr::get($this->virtualProfile->user, 'comment.comments'),
        ];
    }
}
