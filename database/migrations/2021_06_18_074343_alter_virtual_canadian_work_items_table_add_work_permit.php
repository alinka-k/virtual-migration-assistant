<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualCanadianWorkItemsTableAddWorkPermit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_canadian_work_items', function (Blueprint $table) {
            $table->string('work_permit')->nullable();
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
            $table->dropColumn(['work_permit']);
        });
    }
}
