<?php

namespace App\Specifications\Profile;

use App\Models\User\UsersEducationItem;

final class EducationItemSpecification
{
    private UsersEducationItem $education;

    public function __construct(UsersEducationItem $education)
    {
        $this->education = $education;
    }

    public function isCanada(): bool
    {
        return $this->education->location === 'Canada';
    }

    public function isManitoba(): bool
    {
        return $this->education->province === 'Manitoba';
    }

    public function isSatisfiedTypeProgram(): bool
    {
        return in_array($this->education->type_of_program, ['PhD', 'Master']);
    }

    public function isSatisfiedInstitution(): bool
    {
        return $this->isCanada() && $this->education->province === 'British Columbia' && $this->isSatisfiedTypeProgram();
    }

    public function isSatisfiedProgramName(): bool
    {
        return $this->isSatisfiedInstitution() && $this->education->institution && $this->education->institution !== 'Other';
    }

    public function isSatisfiedCompletionDate(): bool
    {
        return $this->education->completed && $this->isCanada() && $this->education->province;
    }

    public function isSatisfiedFieldInSteam(): bool
    {
        return $this->isSatisfiedTypeProgram() && $this->isCanada() && $this->isManitoba();
    }

    public function isSatisfiedFieldInternship(): bool
    {
        return $this->isSatisfiedFieldInSteam() && $this->education->mb_field_in_steam === 'Yes';
    }

    public function isSatisfiedBridgingProgram(): bool
    {
        $programType = ['Bachelor', 'Diploma', 'Technical_Diploma', 'Apprenticeship', 'Associates_Degree', 'Other'];
        return in_array($this->education->type_of_program, $programType) && $this->isCanada() && $this->isManitoba();
    }

    public function isSatisfiedResided(): bool
    {
        $provincesArray = ['New Brunswick', 'Newfoundland and Labrador', 'Nova Scotia', 'Prince Edward Island'];
        return in_array($this->education->province, $provincesArray) && $this->isCanada();
    }
}
