<?php

namespace App\Services\Decorators;

use App\Models\User\UsersWorkHistory;
use App\Services\Profile\WorkHistoryUpdateService;
use App\Specifications\Profile\WorkHistorySpecification;

final class WorkHistoryDecorator
{
    private UsersWorkHistory $job;
    private WorkHistorySpecification $specification;

    public function __construct(UsersWorkHistory $job)
    {
        $this->job = $job;
        $this->specification = new WorkHistorySpecification($this->job);
    }

    public function decorate(): UsersWorkHistory
    {
        if ($this->specification->isCurrentlyWorking()) {
            $this->job->duration = WorkHistoryUpdateService::getDurationByStartDate($this->job->start_date);
        } else {
            $this->job->start_date = null;
        }

        if (!$this->specification->isCanada()) {
            $this->job->province = null;
        }

        if (!($this->specification->isCanada())) {
            $this->job->work_permit = null;
        }

        if (!$this->specification->isOwnershipSatisfied()) {
            $this->job->full_ownership = null;
        }

        return $this->job;
    }
}
