<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\ApiController;
use App\Http\Resources\EvaluationScore as EvaluationScoreResource;
use App\Http\Resources\VirtualProfile\VirtualSaved;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class EvaluationScoreController extends ApiController
{
    /**
     * @OA\Get (
     *  path="/evaluation-score",
     *  operationId="evaluation-score.show",
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
     * @return EvaluationScoreResource | \App\Http\Resources\VirtualProfile\VirtualSaved
     */
    public function show(Request $request)
    {
        if ($request->id) {
            return new EvaluationScoreResource($request->user()->evaluations->last());
        }

        return new VirtualSaved($request);
    }
}
