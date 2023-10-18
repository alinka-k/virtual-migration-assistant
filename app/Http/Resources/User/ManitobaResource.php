<?php

namespace App\Http\Resources\User;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManitobaResource extends JsonResource
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
            'strategic_recruitment_invitation' => Arr::get($this, 'manitoba.strategic_recruitment_invitation'),
        ];
    }
}
