<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToUserLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_languages', function (Blueprint $table) {
            $table->date('language_date')->nullable();
            $table->string('writing_test')->nullable();
            $table->string('reading_test')->nullable();
            $table->string('speaking_test')->nullable();
            $table->string('listening_test')->nullable();
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
            $table->dropColumn('language_date');
            $table->dropColumn('writing_test');
            $table->dropColumn('reading_test');
            $table->dropColumn('speaking_test');
            $table->dropColumn('listening_test');
        });
    }
}
