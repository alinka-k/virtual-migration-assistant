<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLawyerRequestsTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_requests', function (Blueprint $table) {
            $table->dateTime('agreed_date')->nullable()->after('preferred_date');
            $table->string('lawyer_name')->nullable()->after('timezone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lawyer_requests', function (Blueprint $table) {
            $table->dropColumn(['agreed_date', 'lawyer_name']);
        });
    }
}
