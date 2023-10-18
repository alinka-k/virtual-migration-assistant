<?php

namespace App\Services\Permissions\Specifications;

use App\Services\Permissions\PermissionItem;

class BooleanPermission implements Specification
{
    protected PermissionItem $permission;

    public function __construct(PermissionItem $permission)
    {
        $this->permission = $permission;
    }

    public function isSatisfiedBy(): bool
    {
        return filter_var($this->permission->value, FILTER_VALIDATE_BOOLEAN);
    }
}
