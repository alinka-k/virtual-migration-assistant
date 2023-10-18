<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpressEntry extends JsonResource
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
            'existing_profile' => Arr::get($this, 'existing_profile'),
            'invitation_received' => Arr::get($this, 'invitation_received'),
        ];
    }
}
