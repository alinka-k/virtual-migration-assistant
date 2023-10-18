<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualNetWorthTableAddExperienceColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_net_worth', function (Blueprint $table) {
            $table->tinyInteger('business_owner_experience')->after('net_worth')->nullable();
            $table->tinyInteger('senior_manager_experience')->after('business_owner_experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_net_worth', function (Blueprint $table) {
            $table->dropColumn('business_owner_experience');
            $table->dropColumn('senior_manager_experience');
        });
    }
}
