<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 10)->nullable();
            $table->date('dob')->nullable();
            $table->string('residence_country')->nullable();
            $table->string('destination_province')->nullable();
            $table->boolean('stay_in_quebec')->nullable();
            $table->string('stay_in_quebec_duration')->nullable();
            $table->string('manitoba_city_preference')->nullable();
            $table->string('marital_status')->nullable();
            $table->boolean('has_children')->nullable();
            $table->string('children_0_12')->nullable();
            $table->string('children_13_18')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
