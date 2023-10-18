<?php

namespace App\Http\Resources\VirtualProfile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class VirtualSaved extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $programs = $request->user()->evaluations($request->id)->get()->last();
        $eligibility = json_decode(Arr::get($programs, 'eligibility'), true);

        return [
            'fsw' => Arr::get($programs, 'fsw'),
            'crs' => Arr::get($programs, 'crs'),
            'programs' => [
                'federal' => '',
                'totalEligible' => $eligibility ? count(json_decode(Arr::get($programs, 'eligibility'), true)) : 0,
                'other' => json_decode(Arr::get($programs, 'eligibility')),
            ]
        ];
    }
}
