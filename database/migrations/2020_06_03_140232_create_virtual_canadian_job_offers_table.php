<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualCanadianJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_profile_id')->constrained()->onDelete('cascade');
            $table->string('occupation');
            $table->float('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_canadian_job_offers');
    }
}
