<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class Manitoba extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_manitoba')->insert([
            'user_id' => 1,
            'strategic_recruitment_invitation' => null,
        ]);
    }
}
