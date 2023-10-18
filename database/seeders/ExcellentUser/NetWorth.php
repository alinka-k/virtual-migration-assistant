<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class NetWorth extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_net_worth')->insert([
            'user_id' => 1,
            'currency' => 'USD',
            'net_worth' => '10000',
        ]);
    }
}
