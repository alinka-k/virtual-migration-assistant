<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableUsersSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users_subscription');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('users_subscription', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->bigInteger('subscription_id')->unsigned();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table
                ->foreign('subscription_id', 'users_subscription_subscription_id_foreign')
                ->references('id')
                ->on('subscription_packages');
        });
    }
}
