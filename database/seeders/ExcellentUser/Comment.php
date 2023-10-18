<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class Comment extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_comment')->insert([
            'user_id' => 1,
            'has_comments' => 1,
            'comments' => 'Something good',
        ]);
    }
}
