<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CanadianRelativesResource extends JsonResource
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
            'has_friend_mb' => boolOrNull(Arr::get($this, 'relative.has_friend_mb')),
            'has_relatives' => boolOrNull(Arr::get($this, 'relative.has_relatives')),
            'relatives' => CanadianRelativeItemsResource::collection(Arr::get($this, 'relative.items') ?? []),
        ];
    }
}
