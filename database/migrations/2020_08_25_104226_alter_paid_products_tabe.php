<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaidProductsTabe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_info_lawyer_requests', function (Blueprint $table) {
            $table->dropForeign(['lawyer_request_id']);
        });

        Schema::table('paid_products', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_id')->nullable()->after('product');
            $table->string('name')->nullable()->after('id');

            $table->foreign('subscription_id')->references('id')->on('subscription_packages');

            $table->dropForeign(['product']);
            $table->dropColumn(['full_price', 'item_subtype', 'discounted_price', 'product']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paid_products', function (Blueprint $table) {
            $table->dropColumn(['subscription_id', 'permission_id']);
            $table->string('item_subtype')->nullable();
            $table->string('full_price')->nullable();
            $table->string('discounted_price')->nullable();
            $table->unsignedBigInteger('product')->nullable();

            $table->foreign('product')->references('id')->on('subscription_permissions');
        });

        Schema::table('additional_info_lawyer_requests', function (Blueprint $table) {
            $table->foreign('lawyer_request_id')->references('id')->on('lawyer_requests')->onDelete('cascade');
        });
    }
}
