<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIsLookingForWorkFromUserFuturePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_future_plans', function (Blueprint $table) {
            $table->dropColumn('is_looking_for_work');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('future_plans', function (Blueprint $table) {
            $table->boolean('is_looking_for_work')->nullable();
        });
    }
}
