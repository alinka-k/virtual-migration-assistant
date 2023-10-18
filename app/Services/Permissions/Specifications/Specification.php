<?php

namespace App\Services\Permissions\Specifications;

interface Specification
{
    public function isSatisfiedBy(): bool;
}
