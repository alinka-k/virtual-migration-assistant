<?php

namespace App\Services\MergeHelpers;

use App\Models\VirtualProfile;

abstract class BaseHelper
{
    protected VirtualProfile $virtualProfile;

    public function __construct(VirtualProfile $virtualProfile)
    {
        $this->virtualProfile = $virtualProfile;
    }

    abstract public function handle();
}
