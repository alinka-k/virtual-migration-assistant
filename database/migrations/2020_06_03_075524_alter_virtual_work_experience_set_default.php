<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualWorkExperienceSetDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_work_experience', function (Blueprint $table) {
            $table->dropColumn('skilled');
            $table->dropColumn('unskilled');
        });

        Schema::table('virtual_work_experience', function (Blueprint $table) {
            $table->integer('skilled')->after('virtual_profile_id')->default(0);
            $table->integer('unskilled')->after('virtual_profile_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
