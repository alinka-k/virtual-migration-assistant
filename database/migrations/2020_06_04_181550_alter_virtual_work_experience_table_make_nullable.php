<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualWorkExperienceTableMakeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_work_experience', function ($table) {
            $table->string('skilled')->nullable()->change();
            $table->string('unskilled')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_work_experience', function ($table) {
            $table->string('skilled')->nullable(false)->change();
            $table->string('unskilled')->nullable(false)->change();
        });
    }
}
