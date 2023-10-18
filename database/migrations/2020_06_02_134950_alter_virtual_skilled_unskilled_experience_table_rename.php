<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualSkilledUnskilledExperienceTableRename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('virtual_skilled_unskilled_experience', 'virtual_work_experience');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('virtual_work_experience', 'virtual_skilled_unskilled_experience');
    }
}
