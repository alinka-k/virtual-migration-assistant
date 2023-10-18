<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class NetWorthResource extends JsonResource
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
            'net_worth' => (int)Arr::get($this, 'netWorth.net_worth'),
            'currency' => Arr::get($this, 'netWorth.currency') ?? 'CAD',
        ];
    }
}
