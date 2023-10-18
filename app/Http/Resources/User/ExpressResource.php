<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ExpressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'existing_profile' => boolOrNull(Arr::get($this, 'express.existing_profile')),
            'invitation_received' => boolOrNull(Arr::get($this, 'express.invitation_received')),
        ];
    }
}
