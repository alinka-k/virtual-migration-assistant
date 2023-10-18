<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuturePlanProgramsTable extends Migration
{
    private static $titles = [
        "Less than secondary",
        "Secondary school credential",
        "One-year post-secondary credential",
        "Two-year post-secondary credential",
        "Three-year or more post-secondary credential",
        "Two or more post-secondary credentials with at least one being 3+ years",
        "Master's or entry-to-practice professional degree",
        "PhD/doctoral certificate",
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('future_plan_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
        });

        foreach (self::$titles as $title) {
            DB::table('future_plan_programs')->insert(['title' => $title]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('future_plan_programs');
    }
}
