<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateToPaidProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropForeign('product_prices_paid_product_id_foreign');
            $table->renameColumn('paid_product_id', 'product_id');
        });

        Schema::rename('paid_products', 'products');

        Schema::table('product_prices', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropForeign('product_prices_product_id_foreign');
            $table->renameColumn('product_id', 'paid_product_id');
        });

        Schema::rename('products', 'paid_products');

        Schema::table('product_prices', function (Blueprint $table) {
            $table->foreign('paid_product_id')->references('id')->on('paid_products');
        });
    }
}
