<?php

namespace App\Services\Decorators;

use App\Models\User\UserSpouse;
use App\Specifications\Profile\SpouseSpecification;

final class SpouseDecorator
{
    private UserSpouse $spouse;
    private SpouseSpecification $specification;

    public function __construct(UserSpouse $spouse)
    {
        $this->spouse = $spouse;
        $this->specification = new SpouseSpecification($this->spouse);
    }

    public function decorate(): UserSpouse
    {
        if (!$this->specification->handleForeignExpYears()) {
            $this->spouse->foreign_exp_years = null;
        }

        if (!$this->specification->handleCanadianExpYears()) {
            $this->spouse->canadian_exp_years = null;
        }

        return $this->spouse;
    }
}
