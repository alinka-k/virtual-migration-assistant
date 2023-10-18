<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualSpouseOutsideCanadaExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_spouse_outside_canada_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('virtual_spouse_id');
            $table->boolean('highschool_completed')->nullable();
            $table->json('province')->nullable();
            $table->json('type_of_program')->nullable();
            $table->json('duration')->nullable();
            $table->float('skilled')->nullable();
            $table->float('unskilled')->nullable();
            $table->timestamps();
            $table->foreign('virtual_spouse_id', 'virtual_spouse_outside_virtual_spouse_id_foreign')
                ->references('id')->on('virtual_spouse')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_spouse_outside_canada_experience');
    }
}
