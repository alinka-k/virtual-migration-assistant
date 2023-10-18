<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCanadianRelativeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_canadian_relative_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relative_id');
            $table->string('relationship')->nullable();
            $table->string('canadian_status')->nullable();
            $table->string('province')->nullable();
            $table->string('residency_duration')->nullable();
            $table->timestamps();
            $table->foreign('relative_id')->references('id')->on('users_canadian_relatives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_canadian_relative_items');
    }
}
