<?php

namespace App\Specifications;

interface Specification
{
    public function isSatisfiedBy($item): bool;
}
