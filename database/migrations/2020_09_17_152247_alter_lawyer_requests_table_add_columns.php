<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLawyerRequestsTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_requests', function (Blueprint $table) {
            $table->dateTime('preferred_date')->nullable()->after('ordered_service');
            $table->text('message')->nullable()->after('preferred_date');
            $table->string('timezone')->nullable()->after('message');
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
            $table->dropColumn(['preferred_date', 'message', 'timezone']);
        });
    }
}
