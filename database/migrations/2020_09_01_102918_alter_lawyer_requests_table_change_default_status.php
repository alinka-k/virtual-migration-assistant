<?php

use App\Enums\LawyerRequestStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLawyerRequestsTableChangeDefaultStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_requests', function (Blueprint $table) {
            $table->string('status')->default(LawyerRequestStatus::getValue('New'))->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lawyer_requests', function (Blueprint $table) {
            $table->string('status')->default(LawyerRequestStatus::New())->nullable()->change();
        });
    }
}
