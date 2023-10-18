<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationItemsResource extends JsonResource
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
            'type_of_program' => $this->type_of_program,
            'duration' => $this->duration,
            'completed' => boolOrNull($this->completed),
            'location' => $this->location,
            'province' => $this->province,
            'institution' => $this->institution,
            'program_name' => $this->program_name,
            'field_of_study' => $this->field_of_study,
            'completion_date' => $this->completion_date,
            'mb_field_in_steam' => $this->mb_field_in_steam,
            'mb_steam_internship' => $this->mb_steam_internship,
            'mb_bridging_program' => $this->mb_bridging_program,
            'resided_16_months_in_atlantic_province' => boolOrNull($this->resided_16_months_in_atlantic_province),
        ];
    }
}
