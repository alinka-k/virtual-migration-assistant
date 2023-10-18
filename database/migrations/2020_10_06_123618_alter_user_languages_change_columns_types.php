<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserLanguagesChangeColumnsTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_languages', function (Blueprint $table) {
            $table->float('writing')->default(0.0)->change();
            $table->float('reading')->default(0.0)->change();
            $table->float('speaking')->default(0.0)->change();
            $table->float('listening')->default(0.0)->change();

            $table->float('writing_test')->change();
            $table->float('reading_test')->change();
            $table->float('speaking_test')->change();
            $table->float('listening_test')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_languages', function (Blueprint $table) {
            $table->integer('writing')->default(0)->change();
            $table->integer('reading')->default(0)->change();
            $table->integer('speaking')->default(0)->change();
            $table->integer('listening')->default(0)->change();

            $table->integer('writing_test')->change();
            $table->integer('reading_test')->change();
            $table->integer('speaking_test')->change();
            $table->integer('listening_test')->change();
        });
    }
}
