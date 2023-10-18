<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->boolean('has_high_crs')->nullable()->after('token');
            $table->string('result')->nullable()->after('token');
            $table->integer('crs')->nullable()->after('token');
            $table->integer('fsw')->nullable()->after('token');
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
            $table->dropColumn(['crs', 'fsw', 'result', 'has_high_crs']);
        });
    }
}
