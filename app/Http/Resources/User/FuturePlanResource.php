<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class FuturePlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'is_graduation' => boolOrNull(Arr::get($this, 'futurePlan.is_graduation')),
            'program_id' => Arr::get($this, 'futurePlan.program_id'),
            'graduation_date' => Arr::get($this, 'futurePlan.graduation_date'),
            'is_user_program' => boolOrNull(Arr::get($this, 'futurePlan.is_user_program')),
            'user_program' => Arr::get($this, 'futurePlan.user_program'),
            'is_currently_employed' => boolOrNull(Arr::get($this, 'futurePlan.is_currently_employed')),
            'is_interested_in_study' => boolOrNull(Arr::get($this, 'futurePlan.is_interested_in_study')),
            'desired_study' => Arr::get($this, 'futurePlan.desired_study'),
            'type_program' => Arr::get($this, 'futurePlan.type_program'),
            'investment' => Arr::get($this, 'futurePlan.investment'),
            'has_required_budget' => boolOrNull(Arr::get($this, 'futurePlan.has_required_budget')),
        ];
    }
}
