<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class Work extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users_work')->insertGetId([
            'user_id' => 1,
            'has_work_experience_10_yr' => 1,
            'qualification_certificate' => 1,
        ]);

        DB::table('users_work_histories')->insertGetId([
            'work_id' => $id,
            'occupation' => 'Webmaster',
            'noc' => 2175,
            'duration' => 10,
            'when' => 0,
            'schedule_type' => 'Full Time',
            'work_type' => 'Payroll',
            'location' => 'Canada',
            'province' => 'Manitoba',
            'related_to_study_field' => 'Yes',
            'work_permit' => 'NAFTA',
            'full_ownership' => null,
        ]);
    }
}
