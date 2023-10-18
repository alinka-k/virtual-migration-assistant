<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmsToUserCanadianJobOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_canadian_job_offers', function (Blueprint $table) {
            $table->string('atlantic_pilot_registered_employer')->nullable()->after('has_offer');
            $table->string('mb_invitation_to_apply')->nullable()->after('has_offer');
            $table->boolean('ns_health_authority')->nullable()->after('has_offer');
            $table->boolean('sask_1a_driver_licence')->nullable()->after('has_offer');
            $table->string('ab_child_care_experience')->nullable()->after('has_offer');
            $table->string('ab_related_edu_or_experience')->nullable()->after('has_offer');
            $table->string('bc_industry_training_authority_certificate')->nullable()->after('has_offer');
            $table->string('related_experience_years')->nullable()->after('has_offer');
            $table->string('is_related_to_study')->nullable()->after('has_offer');
            $table->string('is_lmia_except')->nullable()->after('has_offer');
            $table->string('has_lmia_approved')->nullable()->after('has_offer');
            $table->boolean('from_current_employer')->nullable()->after('has_offer');
            $table->string('schedule_type')->nullable()->after('has_offer');
            $table->string('duration')->nullable()->after('has_offer');
            $table->string('wage')->nullable()->after('has_offer');
            $table->string('in_bc_northeast_development_region')->nullable()->after('has_offer');
            $table->string('district')->nullable()->after('has_offer');
            $table->string('province')->nullable()->after('has_offer');
            $table->string('occupation')->nullable()->after('has_offer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_canadian_job_offers', function (Blueprint $table) {
            $table->dropColumn([
                'occupation',
                'province',
                'district',
                'in_bc_northeast_development_region',
                'wage',
                'duration',
                'schedule_type',
                'from_current_employer',
                'has_lmia_approved',
                'is_lmia_except',
                'is_related_to_study',
                'related_experience_years',
                'bc_industry_training_authority_certificate',
                'ab_related_edu_or_experience',
                'ab_child_care_experience',
                'sask_1a_driver_licence',
                'ns_health_authority',
                'mb_invitation_to_apply',
                'atlantic_pilot_registered_employer',
            ]);
        });
    }
}
