<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CanadianRelatives extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users_canadian_relatives')->insertGetId([
            'user_id' => 1,
            'has_friend_mb' => 1,
            'has_relatives' => 1,
        ]);

        DB::table('users_canadian_relative_items')->insertGetId([
            'relative_id' => $id,
            'relationship' => 'spouse',
            'canadian_status' => 'Citizen',
            'province' => 'Manitoba',
            'residency_duration' => 2,
        ]);
    }
}
