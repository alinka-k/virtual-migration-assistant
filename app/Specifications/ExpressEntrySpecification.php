<?php

namespace App\Specifications;

use App\Enums\Evaluation;

class ExpressEntrySpecification implements Specification
{
    public function isSatisfiedBy($item): bool
    {
        return (int)$item >= Evaluation::Threshold;
    }
}
