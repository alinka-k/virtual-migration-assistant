<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersWorkHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_work_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id');
            $table->string('occupation')->nullable();
            $table->string('duration')->nullable();
            $table->string('when')->nullable();
            $table->string('schedule_type')->nullable();
            $table->string('work_type')->nullable();
            $table->string('location')->nullable();
            $table->string('province')->nullable();
            $table->string('related_to_study_field')->nullable();
            $table->string('work_permit')->nullable();
            $table->boolean('full_ownership')->nullable();
            $table->timestamps();
            $table->foreign('work_id')->references('id')->on('users_work')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_work_histories');
    }
}
