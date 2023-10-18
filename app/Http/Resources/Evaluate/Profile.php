<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
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
            'age' => Arr::get($this, 'age'),
            'marital_status' => Arr::get($this, 'marital_status'),
            'residence_country' => Arr::get($this, 'residence_country'),
            'destination_province' => Arr::get($this, 'destination_province'),
            'stay_in_quebec' => Arr::get($this, 'stay_in_quebec'),
            'manitoba_city_preference' => Arr::get($this, 'manitoba_city_preference'),
            'stay_in_quebec_duration' => Arr::get($this, 'stay_in_quebec_duration'),
            'has_children' => Arr::get($this, 'has_children'),
            'children_0_12' => Arr::get($this, 'children_0_12'),
            'children_13_18' => Arr::get($this, 'children_13_18'),
        ];
    }
}
