<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFuturePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_future_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('program_id')->nullable();

            $table->date('graduation_date')->nullable();
            $table->boolean('is_currently_employed')->nullable();
            $table->boolean('is_looking_for_work')->nullable();
            $table->boolean('is_interested_in_study')->nullable();
            $table->string('desired_study')->nullable();
            $table->string('type_program')->nullable();
            $table->integer('investment')->nullable();

            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('future_plan_programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_future_plans');
    }
}
