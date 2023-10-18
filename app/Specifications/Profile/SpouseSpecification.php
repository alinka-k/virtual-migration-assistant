<?php

namespace App\Specifications\Profile;

use App\Models\User\UserSpouse;

final class SpouseSpecification
{
    private UserSpouse $spouse;

    public function __construct(UserSpouse $plans)
    {
        $this->spouse = $plans;
    }

    public function handleForeignExpYears(): bool
    {
        return !!$this->spouse->has_foreign_work;
    }

    public function handleCanadianExpYears(): bool
    {
        return !!$this->spouse->has_canadian_work;
    }
}
