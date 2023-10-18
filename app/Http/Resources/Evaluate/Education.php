<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Education extends JsonResource
{
    public const NO_SECONDARY_EDUCATION = [
        [
            'type_of_program' => 'null',
            'completed' => false,
            'duration' => 0
        ]
    ];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'highschool_completed' => (bool)Arr::get($this, 'highschool_completed'),
            'has_post_secondary_education' => (bool)Arr::get($this, 'has_post_secondary_education'),
            'post_secondary_education' =>
                (bool)Arr::get($this, 'highschool_completed') && (bool)Arr::get($this, 'has_post_secondary_education') ?
                EducationItem::collection(Arr::get($this, 'items')) :
                self::NO_SECONDARY_EDUCATION,
        ];
    }
}
