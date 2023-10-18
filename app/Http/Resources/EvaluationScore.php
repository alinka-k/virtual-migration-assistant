<?php

namespace App\Http\Resources;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationScore extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'fsw' => Arr::get($this, 'fsw'),
            'crs' => Arr::get($this, 'crs'),
            'result' => Arr::get($this, 'result'),
            'has_high_crs' => boolOrNull(Arr::get($this, 'has_high_crs')),
        ];
    }
}
