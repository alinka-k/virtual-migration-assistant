<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualProfilesTableSetDefaultName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_profiles', function (Blueprint $table) {
            $table->string('name')->default('Saved path')->nullable()->change();
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
            $table->string('name')->nullable()->change();
        });
    }
}
