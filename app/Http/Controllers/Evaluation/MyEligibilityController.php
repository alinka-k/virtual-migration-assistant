<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\ApiController;
use App\Http\Resources\MyEligibility\MyEligibilityResource;
use App\Services\Points\MyEligibilityBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyEligibilityController extends ApiController
{
    private MyEligibilityBuilder $myEligibilityBuilder;

    public function __construct(MyEligibilityBuilder $myEligibilityBuilder)
    {
        $this->myEligibilityBuilder = $myEligibilityBuilder;
    }

    public function index(Request $request): JsonResponse
    {
        $myEligibilityContent = $this->myEligibilityBuilder->build($request->user());
        if (is_null($myEligibilityContent)) {
            return new JsonResponse(['data' => []]);
        }

        return new JsonResponse([
            'data' => new MyEligibilityResource($myEligibilityContent)
        ]);
    }

    public function programsCount(Request $request): JsonResponse
    {
        $evaluation = $request->user()->evaluations()->whereNull('virtual_profile_id')->get()->last();
        if (!$evaluation) {
            return new JsonResponse(['programsCount' => 0]);
        }

        return new JsonResponse(['programsCount' => count(json_decode($evaluation->eligibility, true))]);
    }
}
