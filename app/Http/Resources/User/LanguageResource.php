<?php

namespace App\Http\Resources\User;

use App\Models\User\UserLanguage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $english = UserLanguage::firstWhere(['user_id' => $this->id, 'language_type'=> 'english']);
        $french = UserLanguage::firstWhere(['user_id' => $this->id, 'language_type'=> 'french']);
        return [
            'english' => [
                'has_test' => boolOrNull(Arr::get($english, 'has_test')),
                'language_test' => Arr::get($english, 'language_test'),
                'language_date' => Arr::get($english, 'language_date'),
                'writing_test' => asNumber(Arr::get($english, 'writing_test')),
                'reading_test' => asNumber(Arr::get($english, 'reading_test')),
                'speaking_test' => asNumber(Arr::get($english, 'speaking_test')),
                'listening_test' => asNumber(Arr::get($english, 'listening_test')),
                'writing' => Arr::get($english, 'writing'),
                'reading' => Arr::get($english, 'reading'),
                'speaking' => Arr::get($english, 'speaking'),
                'listening' => Arr::get($english, 'listening'),
            ],
            'french' => [
                'has_test' => boolOrNull(Arr::get($french, 'has_test')),
                'language_test' => Arr::get($french, 'language_test'),
                'language_date' => Arr::get($french, 'language_date'),
                'writing_test' => asNumber(Arr::get($french, 'writing_test')),
                'reading_test' => asNumber(Arr::get($french, 'reading_test')),
                'speaking_test' => asNumber(Arr::get($french, 'speaking_test')),
                'listening_test' => asNumber(Arr::get($french, 'listening_test')),
                'writing' => Arr::get($french, 'writing'),
                'reading' => Arr::get($french, 'reading'),
                'speaking' => Arr::get($french, 'speaking'),
                'listening' => Arr::get($french, 'listening'),
            ]
        ];
    }
}
