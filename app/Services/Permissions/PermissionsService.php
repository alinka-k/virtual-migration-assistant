<?php

namespace App\Services\Permissions;

use App\Repositories\PermissionsRepository;
use App\Services\Permissions\Specifications\Specification;

class PermissionsService
{
    protected Specification $permission;
    protected array $permissions;
    private PermissionsRepository $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function isSatisfiedBy(string $userId, string $slug): bool
    {
        $permissions = $this->convert($this->permissionsRepository->get($userId));
        $permission = PermissionsFactory::factory(collect($permissions)->firstWhere('slug', $slug));
        return $permission->isSatisfiedBy();
    }

    protected function convert($data): array
    {
        $returnArray = [];
        foreach ($data as $items) {
            $convertedPermission = new PermissionItem();
            foreach ($items as $key => $value) {
                $convertedPermission->{$key} = $value;
            }
            $returnArray[] = $convertedPermission;
        }
        return $returnArray;
    }
}
