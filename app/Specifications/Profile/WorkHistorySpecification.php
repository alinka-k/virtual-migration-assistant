<?php

namespace App\Specifications\Profile;

use App\Models\User\UsersWorkHistory;

final class WorkHistorySpecification
{
    private UsersWorkHistory $job;

    public function __construct(UsersWorkHistory $job)
    {
        $this->job = $job;
    }

    public function isCurrentlyWorking(): bool
    {
        return $this->job->when === '0';
    }

    public function isCanada(): bool
    {
        return $this->job->location === 'Canada';
    }

    public function isOwnershipSatisfied(): bool
    {
        return $this->isCanada() && $this->job->province === 'Nova Scotia' && $this->job->work_type === 'Self-Employed';
    }
}
