<?php

namespace App\Services\Points;

use App\Http\Resources\MyEligibility\MyEligibilityResource;
use App\Models\Evaluate\Evaluation;
use App\Models\User;

class PointsService
{
//    private MyEligibilityBuilder $myEligibilityBuilder;
//
//    public function __construct(MyEligibilityBuilder $myEligibilityBuilder)
//    {
//        $this->myEligibilityBuilder = $myEligibilityBuilder;
//    }
//
//    public function __invoke(Evaluation $evaluation, User $user)
//    {
//        if (empty($crs) || empty($fsw)) {
//            return [];
//        }
//
//        return new MyEligibilityResource($this->myEligibilityBuilder->build($user, $evaluation));
//    }
}
