<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserCompilationSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('users_compilation')->insert([
                'user_id' => $user->id,
                'compilation_data' => json_encode('[]'),
                'percent' => 0,
                'can_profile_be_evaluated' => false,
            ]);
        }
    }
}
