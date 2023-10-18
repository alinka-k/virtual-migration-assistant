<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkHistory extends JsonResource
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
            'occupation' => Arr::get($this, 'occupation'),
            'duration' => Arr::get($this, 'duration'),
            'when' => Arr::get($this, 'when'),
            'schedule_type' => Arr::get($this, 'schedule_type'),
            'work_type' => Arr::get($this, 'work_type'),
            'location' => Arr::get($this, 'location'),
            'province' => Arr::get($this, 'province'),
            'related_to_study_field' => Arr::get($this, 'related_to_study_field'),
            'work_permit' => Arr::get($this, 'work_permit'),
            'full_ownership' => boolOrNull(Arr::get($this, 'full_ownership')),
            'noc' => Arr::get($this, 'noc', ''),
        ];
    }
}
