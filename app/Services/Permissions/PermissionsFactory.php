<?php

namespace App\Services\Permissions;

use App\Services\Permissions\Specifications\BooleanPermission;

class PermissionsFactory
{
    public static function factory(PermissionItem $permission)
    {
        switch ($permission->slug) {
//            case Permission::EligibilityCalculation():
//            case Permission::ScenariosSavedPaths():
//            case Permission::ScenariosActionPlans():
            default:
                return new BooleanPermission($permission);

        }
    }
}
