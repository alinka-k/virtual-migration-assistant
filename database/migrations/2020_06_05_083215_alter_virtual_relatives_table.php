<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AlterVirtualRelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_relatives', function ($table) {
            $table->string('has_friend_mb')->nullable()->change();
            $table->string('has_relatives')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_relatives', function ($table) {
            $table->string('has_friend_mb')->nullable(false)->change();
            $table->string('has_relatives')->nullable(false)->change();
        });
    }
}
