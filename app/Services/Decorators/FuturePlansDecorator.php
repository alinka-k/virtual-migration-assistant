<?php

namespace App\Services\Decorators;

use App\Models\User\UserFuturePlans;
use App\Specifications\Profile\FuturePlansSpecification;

final class FuturePlansDecorator
{
    private UserFuturePlans $plans;
    private FuturePlansSpecification $specification;

    public function __construct(UserFuturePlans $plans)
    {
        $this->plans = $plans;
        $this->specification = new FuturePlansSpecification($this->plans);
    }

    public function decorate(): UserFuturePlans
    {
        if (!$this->specification->isGraduation()) {
            $this->plans->program_id = null;
            $this->plans->graduation_date = null;
            $this->plans->is_user_program = null;
            $this->plans->user_program = null;
        }

        if (!$this->specification->isUserProgram()) {
            $this->plans->user_program = null;
        }

        if (!$this->specification->isInterestedInStudy()) {
            $this->plans->has_required_budget = null;
            $this->plans->desired_study = null;
            $this->plans->type_program = null;
        }

        return $this->plans;
    }
}
