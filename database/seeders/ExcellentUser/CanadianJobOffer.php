<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CanadianJobOffer extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_canadian_job_offers')->insert([
            'user_id' => 1,
            'has_offer' => 1,
            'occupation' => 'Web Developer',
            'province' => 'Manitoba',
            'district' => null,
            'in_bc_northeast_development_region' => null,
            'wage' => null,
            'duration' => '2',
            'schedule_type' => 'Full Time',
            'from_current_employer' => '1',
            'has_lmia_approved' => 'Yes',
            'is_lmia_except' => null,
            'is_related_to_study' => null,
            'related_experience_years' => null,
            'bc_industry_training_authority_certificate' => null,
            'ab_related_edu_or_experience' => 'Yes',
            'ab_child_care_experience' => 'Yes',
            'sask_1a_driver_licence' => null,
            'ns_health_authority' => null,
            'mb_invitation_to_apply' => 'Yes',
            'atlantic_pilot_registered_employer' => null,
        ]);
    }
}
