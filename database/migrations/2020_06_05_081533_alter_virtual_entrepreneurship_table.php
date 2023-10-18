<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AlterVirtualEntrepreneurshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_entrepreneurship', function ($table) {
            $table->string('net_worth')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_job_offers', function ($table) {
            $table->string('net_worth')->nullable(false)->change();
        });
    }
}
