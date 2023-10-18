<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class Languages extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_languages')->insert([
            'user_id' => 1,
            'language_type' => 'english',
            'has_test' => 0,
            'language_test' => null,
            'writing' => 12,
            'reading' => 12,
            'speaking' => 12,
            'listening' => 12,
            'clb' => 12,
            'language_date' => null,
            'writing_test' => null,
            'reading_test' => null,
            'speaking_test' => null,
            'listening_test' => null,
        ]);

        DB::table('user_languages')->insert([
            'user_id' => 1,
            'language_type' => 'french',
            'has_test' => 0,
            'language_test' => null,
            'writing' => 12,
            'reading' => 12,
            'speaking' => 12,
            'listening' => 12,
            'clb' => 12,
            'language_date' => null,
            'writing_test' => null,
            'reading_test' => null,
            'speaking_test' => null,
            'listening_test' => null,
        ]);
    }
}
