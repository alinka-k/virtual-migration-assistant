<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLawyerRequestsTableAddUserRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_requests', function ($table) {
            $table->dropColumn('customer_email');
        });

        Schema::table('lawyer_requests', function ($table) {
            $table->unsignedBigInteger('customer_id')->after('id');

            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lawyer_requests', function ($table) {
            $table->string('customer_email')->nullable();
        });

        Schema::table('lawyer_requests', function ($table) {
            $table->dropColumn('customer_id');
        });
    }
}
