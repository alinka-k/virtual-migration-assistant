<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNocToVirtualSpouseOutsideCanadaExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_spouse_outside_canada_experience', function (Blueprint $table) {
            $table->dropColumn(['skilled', 'unskilled']);

            $table->integer('noc_C_D')->nullable()->after('virtual_spouse_id');
            $table->integer('noc_B')->nullable()->after('virtual_spouse_id');
            $table->integer('noc_A')->nullable()->after('virtual_spouse_id');
            $table->integer('noc_0')->nullable()->after('virtual_spouse_id');
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
            $table->dropColumn(['noc_C_D', 'noc_B', 'noc_A', 'noc_0']);

            $table->integer('skilled')->after('virtual_spouse_id')->default(0);
            $table->integer('unskilled')->after('virtual_spouse_id')->default(0);
        });
    }
}
