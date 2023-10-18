<?php

namespace App\Http\Resources\Evaluate;

use App\Services\Points\PointsService;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Points extends JsonResource
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
            'data' => Arr::get($this, 'points')
                ? (new PointsService(Arr::get($this, 'points'), $request->user()))->getUserPointsData()
                : [],
        ];
    }
}
