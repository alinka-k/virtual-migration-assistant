<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuccessfulUser extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserProfile::class,
            Manitoba::class,
            NetWorth::class,
            Languages::class,
            Comment::class,
            CanadianJobOffer::class,
            Work::class,
            Spouse::class,
            Education::class,
            CanadianRelatives::class,
        ]);
    }
}
