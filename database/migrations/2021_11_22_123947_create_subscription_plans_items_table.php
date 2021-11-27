<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id')->comment('آیدی طرح');
            $table->unsignedBigInteger('plan_price')->comment('هزینه طرح');
            $table->unsignedSmallInteger('time')->comment('مدت طرح (ماه)');
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('subscription_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans_items');
    }
}
