<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletePreviousEducationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('virtual_education_items');
        Schema::dropIfExists('virtual_education');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('virtual_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_profile_id')->constrained()->onDelete('cascade');
            $table->boolean('highschool_completed')->default(0);
        });

        Schema::create('virtual_education_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('virtual_education_id');
            $table->string('type_of_program')->nullable();
            $table->string('duration')->nullable();

            $table->foreign('virtual_education_id')->references('id')->on('virtual_education');
        });
    }
}
