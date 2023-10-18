<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeigntToEvaluationPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluation_points', function (Blueprint $table) {
            $table->dropForeign('evaluation_points_evaluation_id_foreign');
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluation_points', function (Blueprint $table) {
            $table->dropForeign('evaluation_points_evaluation_id_foreign');
            $table->foreign('evaluation_id')->references('id')->on('evaluations');
        });
    }
}
