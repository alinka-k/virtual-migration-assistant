<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSpouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_spouse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('age')->nullable();
            $table->string('education_level')->nullable();
            $table->string('english')->nullable();
            $table->string('french')->nullable();
            $table->boolean('has_foreign_work')->nullable();
            $table->string('foreign_exp_years')->nullable();
            $table->boolean('has_canadian_work')->nullable();
            $table->string('canadian_exp_years')->nullable();
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
        Schema::dropIfExists('users_spouse');
    }
}
