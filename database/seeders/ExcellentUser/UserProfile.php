<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserProfile extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([
            'user_id' => 1,
            'dob' => '1990-01-01',
            'residence_country' => 'Aruba',
            'destination_province' => 'not_sure',
            'stay_in_quebec' => null,
            'stay_in_quebec_duration' => null,
            'manitoba_city_preference' => null,
            'marital_status' => 'married',
            'has_children' => 1,
            'children_0_12' => 1,
            'children_13_18' => 1,
        ]);
    }
}
