<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class SpouseResource extends JsonResource
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
            'age' => Arr::get($this, 'spouse.age'),
            'education_level' => Arr::get($this, 'spouse.education_level'),
            'english' => Arr::get($this, 'spouse.english'),
            'french' => Arr::get($this, 'spouse.french'),
            'has_foreign_work' => boolOrNull(Arr::get($this, 'spouse.has_foreign_work')),
            'foreign_exp_years' => Arr::get($this, 'spouse.foreign_exp_years'),
            'has_canadian_work' => boolOrNull(Arr::get($this, 'spouse.has_canadian_work')),
            'canadian_exp_years' => Arr::get($this, 'spouse.canadian_exp_years'),
        ];
    }
}
