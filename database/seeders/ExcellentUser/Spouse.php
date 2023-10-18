<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class Spouse extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_spouse')->insert([
            'user_id' => 1,
            'age' => 30,
            'education_level' => 'Master',
            'english' => 12,
            'french' => 12,
            'has_foreign_work' => 1,
            'foreign_exp_years' => 6,
            'has_canadian_work' => 1,
            'canadian_exp_years' => 6,
        ]);
    }
}
