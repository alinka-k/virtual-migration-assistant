<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PointsFswLog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * "fsw_score": "98",
         * "fsw_age_score": "12",
         * "fsw_education_score": "23",
         * "fsw_1st_language_score": "24",
         * "fsw_2nd_language_score": "4",
         * "fsw_adaptability_score": "10",
         * "fsw_work_experience_score": "15",
         * "fsw_arranged_employment_score": "10",
         * "fsw_has_close_relative_in_canada": "",
         * "fsw_has_valid_canadian_job_offer": "1",
         * "count_post_secondary_1yr_and_more": "1",
         * "count_post_secondary_2yr_and_more": "1",
         * "count_post_secondary_3yr_and_more": "1",
         * "fsw_spouse_language_primary_clb_4": "1",
         * "fsw_spouse_language_secondary_clb_4": "1",
         * "fsw_1st_language_points_per_category": "24",
         * "fsw_adaptability_has_study_in_canada": "1",
         * "fsw_2nd_language_score_greater_than_5": "1",
         * "fsw_adaptability_work_in_canada_score": "10",
         * "fsw_adaptability_spouse_language_score": "5",
         * "fsw_arranged_employment_noc_is_skilled": "1",
         * "fws_adaptability_study_in_canada_score": "5",
         * "fsw_adaptability_has_work_in_canada_yrs": "10.03",
         * "fsw_adaptability_relative_in_canada_score": "0",
         * "fsw_adaptability_spouse_has_work_in_canada": "1",
         * "fsw_adaptability_spouse_has_study_in_canada": "",
         * "fws_skilled_work_experience_years_past_10yr": "10.03",
         * "fsw_adaptability_spouse_work_in_canada_score": "5",
         * "fws_adaptability_spouse_study_in_canada_score": "0",
         * "fsw_adaptability_valid_canadian_job_offer_score": "5"
         */
        $collection = collect([
            Arr::get($this, 'fsw_spouse_language_primary_clb_4'),
            Arr::get($this, 'fsw_spouse_language_secondary_clb_4'),
            Arr::get($this, 'fsw_adaptability_spouse_language_score'),
            Arr::get($this, 'fsw_adaptability_spouse_has_work_in_canada'),
            Arr::get($this, 'fsw_adaptability_spouse_has_study_in_canada'),
            Arr::get($this, 'fsw_adaptability_spouse_work_in_canada_score'),
            Arr::get($this, 'fws_adaptability_spouse_study_in_canada_score')
        ]);

        $spouse_score = $collection
            ->filter(fn ($value) => !empty($value))
            ->map(fn ($value) => (int)$value)
            ->sum();

        return [
            'fsw_age_score' => asNumber(Arr::get($this, 'fsw_age_score')),
            'fsw_education_score' => asNumber(Arr::get($this, 'fsw_education_score')),
            'fsw_1st_language_score' => asNumber(Arr::get($this, 'fsw_1st_language_score')),
            'fsw_2nd_language_score' => asNumber(Arr::get($this, 'fsw_2nd_language_score')),
            'fsw_work_experience_score' => asNumber(Arr::get($this, 'fsw_work_experience_score')),
            'fsw_spouse_score' => $spouse_score,
        ];
    }
}
