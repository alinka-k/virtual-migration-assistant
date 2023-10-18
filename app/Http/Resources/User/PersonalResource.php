<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class PersonalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'dob' => Arr::get($this, 'profile.dob'),
            'residence_country' => Arr::get($this, 'profile.residence_country'),
            'destination_province' => Arr::get($this, 'profile.destination_province'),
            'stay_in_quebec' => boolOrNull(Arr::get($this, 'profile.stay_in_quebec')),
            'stay_in_quebec_duration' => Arr::get($this, 'profile.stay_in_quebec_duration'),
            'marital_status' => Arr::get($this, 'profile.marital_status'),
            'manitoba_city_preference' => Arr::get($this, 'profile.manitoba_city_preference'),
            'has_children' => boolOrNull(Arr::get($this, 'profile.has_children')),
            'children_0_12' => Arr::get($this, 'profile.children_0_12'),
            'children_13_18' => Arr::get($this, 'profile.children_13_18'),
        ];
    }
}
