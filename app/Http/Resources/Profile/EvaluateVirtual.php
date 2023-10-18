<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\Evaluate\EligibilityProgram as EligibilityProgramResource;
use App\Models\Evaluate\EligibilityProgram;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluateVirtual extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $programs = $request->id ? json_encode($this) : Arr::get(
            $request->user()->evaluationsByUser()->get()->last(),
            'eligibility'
        );

        $federal = EligibilityProgramResource::collection(
            $programs ? EligibilityProgram::whereIn(
                'program_id',
                array_keys(json_decode($programs, true))
            )->where('type', 'FEDERAL')->get() : []
        );

        $otherPrograms = $request->user()->canSeeProvincialPrograms() ? EligibilityProgramResource::collection(
            $programs ? EligibilityProgram::whereIn(
                'program_id',
                array_keys(json_decode($programs, true))
            )->get() : []
        ) : [];

        return [
            'fsw' => Arr::get($this, 'evaluation.fsw'),
            'crs' => Arr::get($this, 'evaluation.crs'),
            'programs' => [
                'federal' => $federal,
                'totalEligible' => $programs ? count(json_decode($programs, true)) : 0,
                'other' => $otherPrograms
            ]
        ];
    }
}
