<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHasPostSecondaryEducationAddNoMoreDiplomas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_education', function (Blueprint $table) {
            $table->boolean('no_more_diplomas')->nullable()->after('has_post_secondary_education');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_education', function (Blueprint $table) {
            $table->dropColumn('no_more_diplomas');
        });
    }
}

