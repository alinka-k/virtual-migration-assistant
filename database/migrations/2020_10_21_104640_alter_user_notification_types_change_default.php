<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserNotificationTypesChangeDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notification_types', function (Blueprint $table) {
            $table->boolean('express_entry')->default(true)->change();
            $table->boolean('all_programs')->change();
            $table->boolean('lawyer_consultation')->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notification_types', function (Blueprint $table) {
            $table->boolean('express_entry')->default(false)->change();
            $table->boolean('all_programs')->default(false)->change();
            $table->boolean('lawyer_consultation')->default(false)->change();
        });
    }
}
