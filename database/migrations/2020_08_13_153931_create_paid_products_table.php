<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product')->nullable();
            $table->string('item_subtype')->nullable();
            $table->string('full_price')->nullable();
            $table->string('discounted_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->foreign('product')->references('id')->on('subscription_permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paid_products');
    }
}
