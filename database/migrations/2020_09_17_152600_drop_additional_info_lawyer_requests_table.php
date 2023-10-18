<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAdditionalInfoLawyerRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('additional_info_lawyer_requests');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('additional_info_lawyer_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawyer_request_id');
            $table->dateTime('preferred_date')->nullable();
            $table->text('message')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamps();

            $table->foreign('lawyer_request_id')->references('id')->on('lawyer_requests')->onDelete('cascade');
        });
    }
}
