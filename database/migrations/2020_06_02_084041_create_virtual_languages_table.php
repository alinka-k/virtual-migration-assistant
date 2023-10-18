<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_profile_id')->constrained()->onDelete('cascade');
            $table->enum('language_type', ['english', 'french']);
            $table->string('language_test')->nullable();
            $table->float('clb')->nullable();
            $table->float('writing')->nullable();
            $table->float('reading')->nullable();
            $table->float('speaking')->nullable();
            $table->float('listening')->nullable();
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
        Schema::dropIfExists('virtual_languages');
    }
}
