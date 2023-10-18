<?php

namespace App\Services\Decorators;

use App\Models\User\UsersEducationItem;
use App\Specifications\Profile\EducationItemSpecification;

final class EducationItemDecorator
{
    private UsersEducationItem $education;
    private EducationItemSpecification $specification;

    public function __construct(UsersEducationItem $education)
    {
        $this->education = $education;
        $this->specification = new EducationItemSpecification($this->education);
    }

    public function decorate(): UsersEducationItem
    {
        if (!$this->specification->isCanada()) {
            $this->education->province = null;
        }
        if (!$this->specification->isSatisfiedInstitution()) {
            $this->education->institution = null;
        }
        if (!$this->specification->isSatisfiedProgramName()) {
            $this->education->program_name = null;
        }
        if (!$this->specification->isSatisfiedCompletionDate()) {
            $this->education->completion_date = null;
        }
        if (!$this->specification->isSatisfiedFieldInSteam()) {
            $this->education->mb_field_in_steam = null;
        }
        if (!$this->specification->isSatisfiedFieldInternship()) {
            $this->education->mb_steam_internship = null;
        }
        if (!$this->specification->isSatisfiedBridgingProgram()) {
            $this->education->mb_bridging_program = null;
        }
        if (!$this->specification->isSatisfiedResided()) {
            $this->education->resided_16_months_in_atlantic_province = null;
        }

        return $this->education;
    }
}
