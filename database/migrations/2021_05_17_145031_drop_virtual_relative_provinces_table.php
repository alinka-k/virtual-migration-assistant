<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVirtualRelativeProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('virtual_relative_provinces');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('virtual_relative_provinces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virtual_relative_id')->constrained()->onDelete('cascade');
            $table->string('province')->nullable();
        });
    }
}
