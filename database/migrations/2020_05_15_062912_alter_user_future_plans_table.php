<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserFuturePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_future_plans', function (Blueprint $table) {
            $table->boolean('is_graduation')->nullable()->after('user_id');
            $table->string('user_program', 255)->nullable()->after('graduation_date');
            $table->boolean('is_user_program')->nullable()->after('graduation_date');
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
            $table->dropColumn('is_graduation');
            $table->dropColumn('is_user_program');
            $table->dropColumn('user_program');
        });
    }
}
