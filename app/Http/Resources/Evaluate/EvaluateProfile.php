<?php

namespace App\Http\Resources\Evaluate;

use App\Models\User\UserLanguage;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluateProfile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $english = UserLanguage::firstWhere(['user_id' => $this->id, 'language_type' => 'english']);
        $french = UserLanguage::firstWhere(['user_id' => $this->id, 'language_type' => 'french']);

        return [
            'principal_applicant' => [
                'first_name' => Arr::get($this, 'first_name'),
                'last_name' => Arr::get($this, 'last_name'),
                'email' => Arr::get($this, 'email'),
                'phone' => Arr::get($this, 'phone'),
            ],
            'profile' => new Profile($this->profile),
            'language' => [
                'english' => [
                    'writing' => Arr::get($english, 'writing'),
                    'reading' => Arr::get($english, 'reading'),
                    'speaking' => Arr::get($english, 'speaking'),
                    'listening' => Arr::get($english, 'listening'),
                ],
                'french' => [
                    'writing' => Arr::get($french, 'writing'),
                    'reading' => Arr::get($french, 'reading'),
                    'speaking' => Arr::get($french, 'speaking'),
                    'listening' => Arr::get($french, 'listening'),
                ]
            ],
            'education' => new Education($this->education),
            'work' => new Work($this->work),
            'canadian_relatives' => new CanadianRelatives($this->relative),
            'manitoba' => new Manitoba($this->manitoba),
            'canadian_job_offer' => new CanadianJobOffer($this->jobOffer),
            'spouse' => new Spouse($this->spouse),
            'personal_net_worth' => new NetWorth($this->netWorth),
            'comments' => new Comments($this->comment),
        ];
    }
}
