<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanadianRelatives extends JsonResource
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
            'has_friend_mb' => (bool)Arr::get($this, 'has_friend_mb'),
            'has_relatives' => (bool)Arr::get($this, 'has_relatives'),
            'relatives' => CanadianRelativesItem::collection(Arr::get($this, 'items') ?? []),
        ];
    }
}
