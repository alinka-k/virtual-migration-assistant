<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFieldsFromVirtualRelatives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_relatives', function (Blueprint $table) {
            $table->dropColumn('relationship');
            $table->dropColumn('canadian_status');
            $table->dropColumn('residency_duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_relatives', function (Blueprint $table) {
            $table->string('relationship')->nullable();
            $table->string('canadian_status')->nullable();
            $table->string('residency_duration')->nullable();
        });
    }
}
