<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EligibilityProgram extends JsonResource
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
            'program_id' => Arr::get($this, 'program_id'),
            'label' => Arr::get($this, 'label'),
            'status' => Arr::get($this, 'status'),
            'tracker' => Arr::get($this, 'tracker'),
            'type' => Arr::get($this, 'type'),
        ];
    }
}
