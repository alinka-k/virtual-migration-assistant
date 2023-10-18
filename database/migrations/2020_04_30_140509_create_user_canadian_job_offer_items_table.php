<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCanadianJobOfferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_canadian_job_offer_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->string('occupation')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('in_bc_northeast_development_region')->nullable();
            $table->string('wage')->nullable();
            $table->string('duration')->nullable();
            $table->string('schedule_type')->nullable();
            $table->boolean('from_current_employer')->nullable();
            $table->string('has_lmia_approved')->nullable();
            $table->string('is_lmia_except')->nullable();
            $table->string('is_related_to_study')->nullable();
            $table->string('related_experience_years')->nullable();
            $table->string('bc_industry_training_authority_certificate')->nullable();
            $table->string('ab_related_edu_or_experience')->nullable();
            $table->string('ab_child_care_experience')->nullable();
            $table->boolean('sask_1a_driver_licence')->nullable();
            $table->boolean('ns_health_authority')->nullable();
            $table->string('mb_invitation_to_apply')->nullable();
            $table->string('atlantic_pilot_registered_employer')->nullable();
            $table->timestamps();
            $table->foreign('offer_id')->references('id')->on('user_canadian_job_offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_canadian_job_offer_items');
    }
}
