<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualCanadianStudyProvinceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_canadian_study_provinces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('virtual_canadian_study_id')->unsigned();
            $table
                ->foreign('virtual_canadian_study_id', 'virtual_ca_study_province_id_foreign')
                ->references('id')
                ->on('virtual_canadian_study')
                ->onDelete('cascade');
            $table->string('province');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_canadian_study_provinces');
    }
}
