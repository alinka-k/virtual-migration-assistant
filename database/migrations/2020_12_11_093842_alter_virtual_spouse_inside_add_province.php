<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVirtualSpouseInsideAddProvince extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_spouse_inside_canada_experience', function (Blueprint $table) {
            $table->json('province')->nullable()->after('unskilled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_spouse_inside_canada_experience', function (Blueprint $table) {
            $table->dropColumn('province');
        });
    }
}
