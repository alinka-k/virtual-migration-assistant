<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class EducationResource extends JsonResource
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
            'highschool_completed' => boolOrNull(Arr::get($this, 'education.highschool_completed')),
            'has_post_secondary_education' => boolOrNull(Arr::get($this, 'education.has_post_secondary_education')),
            'no_more_diplomas' => Arr::get($this, 'education.no_more_diplomas'),
            'post_secondary_education' => EducationItemsResource::collection(Arr::get($this, 'education.items') ?? []),
        ];
    }
}
