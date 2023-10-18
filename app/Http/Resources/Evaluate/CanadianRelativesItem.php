<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanadianRelativesItem extends JsonResource
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
            'relationship' => Arr::get($this, 'relationship'),
            'canadian_status' => Arr::get($this, 'canadian_status'),
            'province' => Arr::get($this, 'province'),
            'residency_duration' => Arr::get($this, 'residency_duration'),
        ];
    }
}
