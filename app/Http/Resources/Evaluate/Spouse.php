<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Spouse extends JsonResource
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
            'age' => asNumber(Arr::get($this, 'age')),
            'education_level' => Arr::get($this, 'education_level'),
            'english' => Arr::get($this, 'english'),
            'french' => Arr::get($this, 'french'),
            'has_foreign_work' => (bool)Arr::get($this, 'has_foreign_work'),
            'foreign_exp_years' => Arr::get($this, 'foreign_exp_years'),
            'has_canadian_work' => (bool)Arr::get($this, 'has_canadian_work'),
            'canadian_exp_years' => Arr::get($this, 'canadian_exp_years'),
        ];
    }
}
