<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualProfilesAddOnDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_profiles', function (Blueprint $table) {
            $table->dropForeign('virtual_profiles_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_profiles', function (Blueprint $table) {
            $table->dropForeign('virtual_profiles_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
