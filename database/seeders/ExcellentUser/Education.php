<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class Education extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users_education')->insertGetId([
            'user_id' => 1,
            'highschool_completed' => 1,
            'has_post_secondary_education' => 1,
        ]);

        DB::table('users_education_items')->insertGetId([
            'education_id' => $id,
            'type_of_program' => 'Master',
            'duration' => 4,
            'completed' => 1,
            'location' => "Canada",
            'province' => 'Manitoba',
            'institution' => 'Trinity Western University',
            'program_name' => 'Other',
            'field_of_study' => null,
            'completion_date' => '2016-01-13',
            'mb_field_in_steam' => 'Yes',
            'mb_steam_internship' => 'Yes',
            'mb_bridging_program' => null,
            'resided_16_months_in_atlantic_province' => null,
        ]);
    }
}
