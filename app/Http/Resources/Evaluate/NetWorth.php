<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NetWorth extends JsonResource
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
            'net_worth' => asNumber(Arr::get($this, 'net_worth')),
        ];
    }
}
