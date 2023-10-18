<?php

namespace App\Models;

use App\Enums\Permission;
use App\Services\Permissions\PermissionsService;

trait HasAccess
{
    private PermissionsService $permissionsService;

    public function __construct()
    {
        $this->permissionsService = resolve(PermissionsService::class);
    }

    public function canSaveVirtualProfile(): bool
    {
        return $this->permissionsService->isSatisfiedBy($this->id, Permission::PathwaySaveScenarios());
    }

    public function canSeeProvincialPrograms(): bool
    {
        return $this->permissionsService->isSatisfiedBy($this->id, Permission::PathwayEvaluate());
    }

    public function canBeNotifiedOfAllPrograms(): bool
    {
        return $this->permissionsService->isSatisfiedBy($this->id, Permission::NotificationForEligiblePrograms());
    }
}
