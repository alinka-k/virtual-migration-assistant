<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHasWorkExperience10YrAddNoMoreWorks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_work', function (Blueprint $table) {
            $table->boolean('no_more_works')->nullable()->after('has_work_experience_10_yr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_work', function (Blueprint $table) {
            $table->dropColumn('no_more_works');
        });
    }
}
