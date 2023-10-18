<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRenamePackagePlansTable extends Migration
{
    public function up()
    {
        Schema::rename('package_plans', 'subscription_package_plans');
    }

    public function down()
    {
        Schema::rename('subscription_package_plans', 'package_plans');
    }
}
