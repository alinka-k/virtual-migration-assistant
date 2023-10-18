<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPackageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_package_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_id')->unsigned();
            $table->bigInteger('value_id')->unsigned();
            $table->timestamps();

            $table
                ->foreign('subscription_id', 'subscription_package_items_subscription_id_foreign')
                ->references('id')
                ->on('subscription_packages');

            $table
                ->foreign('value_id', 'subscription_items_value_id_foreign')
                ->references('id')
                ->on('subscription_permission_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_package_items');
    }
}
