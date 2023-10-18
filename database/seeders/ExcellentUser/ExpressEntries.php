<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ExpressEntries extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_express_entries')->insert([
            'user_id' => 1,
            'existing_profile' => 1,
            'invitation_received' => 1,
        ]);
    }
}
