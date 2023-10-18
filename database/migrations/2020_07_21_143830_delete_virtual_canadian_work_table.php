<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteVirtualCanadianWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('virtual_canadian_work_provinces');
        Schema::dropIfExists('virtual_canadian_work');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('virtual_canadian_work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_profile_id')->constrained()->onDelete('cascade');
            $table->string('occupation')->nullable();
            $table->string('duration')->nullable();
        });
        Schema::create('virtual_canadian_work_provinces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('virtual_canadian_work_id')->unsigned();
            $table
                ->foreign('virtual_canadian_work_id')
                ->references('id')
                ->on('virtual_canadian_work')
                ->onDelete('cascade');
            $table->string('province');
        });
    }
}
