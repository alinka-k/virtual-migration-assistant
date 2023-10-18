<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaidProductsAddTypeAddTitleAddPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paid_products', function (Blueprint $table) {
            $table->string('type')->nullable()->after('id');
        });

        Schema::table('product_prices', function (Blueprint $table) {
            $table->string('price_id')->after('id');
            $table->string('title')->after('id');
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
            $table->dropColumn(['type']);
        });

        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropColumn(['price_id', 'title']);
        });
    }
}
