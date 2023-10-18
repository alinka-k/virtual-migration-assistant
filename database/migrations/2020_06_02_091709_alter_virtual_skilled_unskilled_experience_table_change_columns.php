<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualSkilledUnskilledExperienceTableChangeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_skilled_unskilled_experience', function (Blueprint $table) {
            $table->renameColumn('years', 'unskilled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_skilled_unskilled_experience', function (Blueprint $table) {
            $table->renameColumn('unskilled', 'years');
        });
    }
}
