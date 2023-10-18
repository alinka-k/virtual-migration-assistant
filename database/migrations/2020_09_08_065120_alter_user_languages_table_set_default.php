<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserLanguagesTableSetDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_languages', function (Blueprint $table) {
            $table->string('writing')->default(null)->change();
            $table->string('reading')->default(null)->change();
            $table->string('speaking')->default(null)->change();
            $table->string('listening')->default(null)->change();

            $table->string('writing_test')->change();
            $table->string('reading_test')->change();
            $table->string('speaking_test')->change();
            $table->string('listening_test')->change();
        });
    }
}
