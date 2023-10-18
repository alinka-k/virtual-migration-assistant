<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationItem extends JsonResource
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
            'type_of_program' => Arr::get($this, 'type_of_program'),
            'duration' => Arr::get($this, 'duration'),
            'completed' => boolOrNull(Arr::get($this, 'completed')),
            'location' => Arr::get($this, 'location'),
            'province' => Arr::get($this, 'province'),
            'institution' => Arr::get($this, 'institution'),
            'program_name' => Arr::get($this, 'program_name'),
            'field_of_study' => Arr::get($this, 'field_of_study'),
            'completion_date' => Arr::get($this, 'completion_date'),
            'mb_field_in_steam' => Arr::get($this, 'mb_field_in_steam'),
            'mb_steam_internship' => Arr::get($this, 'mb_steam_internship'),
            'mb_bridging_program' => Arr::get($this, 'mb_bridging_program'),
            'resided_16_months_in_atlantic_province' => boolOrNull(Arr::get($this, 'resided_16_months_in_atlantic_province')),
        ];
    }
}
