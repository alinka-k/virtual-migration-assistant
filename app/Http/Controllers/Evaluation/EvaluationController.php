<?php

namespace App\Http\Controllers\Evaluation;

use App\Events\EligibilityPrograms\ExpressEntryPassed as ExpressEntryPassedEvent;
use App\Events\EligibilityPrograms\SendEligibility as SendEligibilityEvent;
use App\Http\Controllers\ApiController;
use App\Http\Resources\EvaluationScore as EvaluationScoreResource;
use App\Http\Resources\Profile\EvaluateVirtual as EvaluateVirtualResource;
use App\Services\Evaluation as EvaluationService;
use App\Services\VirtualProfileService;
use App\Specifications\ExpressEntrySpecification;
use Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class EvaluationController extends ApiController
{
    private EvaluationService $evaluationService;

    private VirtualProfileService $profileService;

    private ExpressEntrySpecification $specification;

    public function __construct(
        EvaluationService         $evaluationService,
        VirtualProfileService     $profileService,
        ExpressEntrySpecification $specification
    )
    {
        $this->evaluationService = $evaluationService;
        $this->profileService = $profileService;
        $this->specification = $specification;
    }

    /**
     * @OA\Post (
     *  path="/evaluate",
     *  operationId="evaluate.store",
     *  tags={"evaluate"},
     *  security={{"bearerAuth":{}}},
     *  @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(ref="#/components/schemas/EvaluationScore"),
     *  ),
     *  @OA\Response(response=400, description="Error"),
     * )
     * @param Request $request
     * @return JsonResponse|EvaluationScoreResource
     */
    public function store(Request $request)
    {
        if ($evaluation = $this->evaluationService->create($request->user()->id)) {
            if ($this->specification->isSatisfiedBy(Arr::get($evaluation, 'fsw', 0))) {
                event(new ExpressEntryPassedEvent($request->user()));
            }
            if ($evaluation->user->canBeNotifiedOfAllPrograms() && !empty($evaluation->eligibilityFormatted)) {
                event(new SendEligibilityEvent($evaluation));
            }
            return new EvaluationScoreResource($request->user()->evaluations->last());
        }
        return new JsonResponse(['errors' => 'Please complete all of the required fields. This will allow us to evaluate your profile.'], 400);
    }

    /**
     * @OA\Post (
     *  path="/evaluate-virtual",
     *  operationId="evaluate.virtual",
     *  tags={"evaluate"},
     *  security={{"bearerAuth":{}}},
     *  @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(ref="#/components/schemas/EvaluationVirtual")
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(ref="#/components/schemas/EvaluationVirtual"),
     *  ),
     *  @OA\Response(response=400, description="Error"),
     * )
     * @param Request $request
     * @return JsonResponse|EvaluateVirtualResource
     */
    public function evaluate(Request $request)
    {
        if ($this->profileService->evaluate($request)) {
            if ($request->id) {
                return new EvaluateVirtualResource($request->user()->virtualProfiles->where('id', $request->id)->first());
            }
            return new EvaluateVirtualResource($request->user()->virtualProfiles->where('user_id', $request->user()->id)->where('saved', 0)->last());
        }

        return new JsonResponse(['errors' => 'Evaluation is not available at the moment'], 500);
    }
}
