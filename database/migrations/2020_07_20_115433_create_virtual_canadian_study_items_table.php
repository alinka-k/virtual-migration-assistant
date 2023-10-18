<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualCanadianStudyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_canadian_study_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_profile_id')->constrained()->onDelete('cascade');
            $table->string('type_of_program')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('completed')->nullable();
            $table->string('location')->nullable();
            $table->string('province')->nullable();
            $table->string('institution')->nullable();
            $table->string('program_name')->nullable();
            $table->string('field_of_study')->nullable();
            $table->string('completion_date')->nullable();
            $table->string('mb_field_in_steam')->nullable();
            $table->string('mb_steam_internship')->nullable();
            $table->string('mb_bridging_program')->nullable();
            $table->boolean('resided_16_months_in_atlantic_province')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_canadian_study_items');
    }
}
