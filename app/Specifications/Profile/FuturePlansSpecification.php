<?php

namespace App\Specifications\Profile;

use App\Models\User\UserFuturePlans;

final class FuturePlansSpecification
{
    private UserFuturePlans $plans;

    public function __construct(UserFuturePlans $plans)
    {
        $this->plans = $plans;
    }

    public function isGraduation(): bool
    {
        return !!$this->plans->is_graduation;
    }

    public function isUserProgram(): bool
    {
        return !!$this->plans->is_user_program;
    }

    public function isInterestedInStudy(): bool
    {
        return !!$this->plans->is_interested_in_study;
    }
}
