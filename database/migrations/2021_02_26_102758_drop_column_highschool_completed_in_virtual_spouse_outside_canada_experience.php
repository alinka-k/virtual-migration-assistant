<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnHighschoolCompletedInVirtualSpouseOutsideCanadaExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_spouse_outside_canada_experience', function (Blueprint $table) {
            $table->dropColumn('highschool_completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_spouse_outside_canada_experience', function (Blueprint $table) {
            $table->boolean('highschool_completed')->nullable();
        });
    }
}
