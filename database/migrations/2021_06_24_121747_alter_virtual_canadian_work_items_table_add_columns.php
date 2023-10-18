<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualCanadianWorkItemsTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_canadian_work_items', function (Blueprint $table) {
            $table->string('schedule_type')->nullable();
            $table->string('work_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_canadian_work_items', function (Blueprint $table) {
            $table->dropColumn(['schedule_type']);
            $table->dropColumn(['work_type']);
        });
    }
}
