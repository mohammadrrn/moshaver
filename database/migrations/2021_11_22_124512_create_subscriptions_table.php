<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('آیدی کاربر');
            $table->unsignedBigInteger('plan_id')->comment('آیدی طرح خریداری شده');
            $table->unsignedBigInteger('item_id')->comment('آیدی آیتم خریداری شده');
            $table->timestamp('expiry_date')->comment('تاریخ انقضای طرح خریداری شده');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('subscription_plans');
            $table->foreign('item_id')->references('id')->on('subscription_plans_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
