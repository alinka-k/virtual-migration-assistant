<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersWorkHistoriesTableRenameOccupationNoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_work_histories', function (Blueprint $table) {
            $table->renameColumn('occupation_noc', 'noc');
        });

        Schema::table('users_work_histories', function (Blueprint $table) {
            $table->string('noc')->nullable()->change();
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
            $table->integer('noc')->nullable()->change();
        });

        Schema::table('users_work_histories', function (Blueprint $table) {
            $table->renameColumn('noc', 'occupation_noc');
        });
    }
}
