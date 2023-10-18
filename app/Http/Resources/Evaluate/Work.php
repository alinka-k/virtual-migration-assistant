<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Work extends JsonResource
{
    public const NO_WORK_EXPERIENCE = [
        [
            'when' => 'null',
            'duration' => 'null',
            'schedule_type' => 'null',
            'occupation' => 'null'
        ]
    ];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'has_work_experience_10_yr' => Arr::get($this, 'has_work_experience_10_yr'),
            'qualification_certificate' => Arr::get($this, 'qualification_certificate'),
            'history' => Arr::get($this, 'has_work_experience_10_yr') ?
                WorkHistory::collection(Arr::get($this, 'histories')) :
                self::NO_WORK_EXPERIENCE,
        ];
    }
}
