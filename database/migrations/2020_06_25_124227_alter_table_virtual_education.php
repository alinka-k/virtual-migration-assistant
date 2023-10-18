<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVirtualEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_education', function ($table) {
            $table->dropColumn('type_of_program');
            $table->dropColumn('duration');
        });

        Schema::create('virtual_education_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('virtual_education_id');
            $table->string('type_of_program')->nullable();
            $table->string('duration')->nullable();

            $table->foreign('virtual_education_id')->references('id')->on('virtual_education');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_education', function ($table) {
            $table->json('type_of_program')->nullable();
            $table->json('duration')->nullable();
        });

        Schema::dropIfExists('virtual_education_items');
    }
}
