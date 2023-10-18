<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOccupationNocToUsersWorkHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_work_histories', function (Blueprint $table) {
            $table->integer('occupation_noc')->after('occupation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_work_histories', function (Blueprint $table) {
            $table->dropColumn('occupation_noc');
        });
    }
}
