<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('آیدی کاربر');
            $table->unsignedBigInteger('plan_id')->comment('آیدی پلن');
            $table->unsignedBigInteger('item_id')->comment('آیدی آیتم');
            $table->unsignedBigInteger('amount')->comment('مبلغ پرداختی(ریال)');
            $table->string('code')->comment('کد نتیجه تراکنش')->nullable();
            $table->unsignedBigInteger('ref_id')->comment('کد پیگیری')->nullable();
            $table->string('card_pan')->comment('شماره کارت')->nullable();
            $table->string('description')->comment('توضیحات پرداخت');
            $table->boolean('status')->comment('وضعیت پرداخت')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
