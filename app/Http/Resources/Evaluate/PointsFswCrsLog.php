<?php

namespace App\Http\Resources\Evaluate;

use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PointsFswCrsLog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
        "fsw_age_crs": "95",
        "fsw_crs_score": "691",
        "min_french_clb": "12",
        "min_english_clb": "12",
        "fsw_education_crs": "126",
        "fsw_1sl_language_crs": "128",
        "fsw_2nd_language_crs": "22",
        "fsw_bonus_points_crs": "110",
        "fsw_bonus_job_offer_crs": "50",
        "fsw_spouse_1st_lang_crs": "20",
        "fsw_spouse_education_crs": "10",
        "fsw_human_capital_lang_min": "12",
        "fsw_bonus_study_in_canada_crs": "30",
        "fsw_human_capital_total_score": "481",
        "fsw_skill_transferibility_crs": "100",
        "fsw_2nd_language_crs_base_score": "24",
        "fsw_foreign_work_experience_years": "0",
        "fsw_canadian_work_experience_years": "10.03",
        "fsw_bonus_provincial_nomination_crs": "0",
        "fsw_human_capital_sibling_bonus_crs": "0",
        "fsw_has_arranged_employement_noc_00_crs": "",
        "fsw_human_capital_french_lang_bonus_crs": "30",
        "fsw_human_capital_has_sibling_in_canada": "",
        "fsw_skill_transferibility_education_crs": "50",
        "fsw_spouse_canadian_work_experience_crs": "10",
        "spouse_count_post_secondary_1yr_and_more": "1",
        "spouse_count_post_secondary_2yr_and_more": "0",
        "spouse_count_post_secondary_3yr_and_more": "0",
        "fsw_has_arranged_employement_noc_0_A_B_crs": "1",
        "count_post_secondary_1yr_and_more_in_canada": "1",
        "fsw_human_capital_trade_certificate_and_lang": "50",
        "fsw_skill_transferibility_work_experience_crs": "0",
        "fsw_human_capital_canadian_work_experience_crs": "70",
        "fst_skilled_work_experience_on_grup_total_years": "0",
        "fsw_spouse_canadian_work_experience_total_years": "6",
        "fsw_skill_transferibility_canadian_exp_w_edu_crs": "50",
        "fsw_human_capital_foreign_work_experience_total_years": "0",
        "count_post_secondary_3yr_and_more_or_master_phd_in_canada": "1",
        "fsw_skill_transferibility_work_foreign_and_work_canadian_crs": "0"
          */

        $collection = collect([
            Arr::get($this, 'fsw_spouse_1st_lang_crs'),
            Arr::get($this, 'fsw_spouse_education_crs'),
            Arr::get($this, 'fsw_spouse_canadian_work_experience_crs'),
            Arr::get($this, 'spouse_count_post_secondary_1yr_and_more'),
            Arr::get($this, 'spouse_count_post_secondary_2yr_and_more'),
            Arr::get($this, 'spouse_count_post_secondary_3yr_and_more'),
            Arr::get($this, 'fsw_spouse_canadian_work_experience_total_years')
        ]);

        $spouse_score = $collection
            ->filter(fn ($value) => !empty($value))
            ->map(fn ($value) => (int)$value)
            ->sum();

        return [
            'fsw_age_crs' => asNumber(Arr::get($this, 'fsw_age_crs')),
            'fsw_education_crs' => asNumber(Arr::get($this, 'fsw_education_crs')),
            'fsw_1sl_language_crs' => asNumber(Arr::get($this, 'fsw_1sl_language_crs')),
            'fsw_2nd_language_crs' => asNumber(Arr::get($this, 'fsw_2nd_language_crs')),
            'fsw_human_capital_canadian_work_experience_crs' => asNumber(Arr::get($this, 'fsw_human_capital_canadian_work_experience_crs')),
            'fsw_spouse_score' => $spouse_score,
        ];
    }
}
