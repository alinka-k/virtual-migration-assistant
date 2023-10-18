<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHasRequiredBudgetToUserFuturePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_future_plans', function (Blueprint $table) {
            $table->boolean('has_required_budget')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_future_plans', function (Blueprint $table) {
            $table->string('has_required_budget')->nullable()->change();
        });
    }
}
