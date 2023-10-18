<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEvaluationsTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->boolean('cec_passed')->nullable()->after('eligibility');
            $table->boolean('fst_passed')->nullable()->after('eligibility');
            $table->boolean('fsw_passed')->nullable()->after('eligibility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn(['cec_passed', 'fst_passed', 'fsw_passed']);
        });
    }
}
