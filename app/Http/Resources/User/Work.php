<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Work extends JsonResource
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
            'no_more_works' => $this->no_more_works,
            'has_work_experience_10_yr' => boolOrNull($this->has_work_experience_10_yr),
            'qualification_certificate' => boolOrNull($this->qualification_certificate),
            'history' => WorkHistory::collection($this->histories ?? []),
        ];
    }
}
