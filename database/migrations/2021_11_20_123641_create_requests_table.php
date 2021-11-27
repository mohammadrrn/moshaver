<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->comment('نام و نام خانوادگی');
            $table->string('mobile_number', 11)->comment('شماره همراه');
            $table->unsignedBigInteger('area_id')->comment('آیدی منطقه');
            $table->unsignedBigInteger('transfer_id')->comment('آیدی نوع واگذاری');
            $table->unsignedBigInteger('estate_id')->comment('آیدی نوع ملک');
            $table->string('range_of_address')->comment('حدود آدرس');
            $table->string('rang_of_area')->comment('حدود متراژ درخواستی');
            $table->unsignedBigInteger('buy_price')->comment('مبلغ خرید')->nullable()->default(0);
            $table->unsignedBigInteger('mortgage_price')->comment('مبلغ رهن')->nullable()->default(0);
            $table->unsignedBigInteger('rent_price')->comment('مبلغ اجاره')->nullable()->default(0);
            $table->text('description')->comment('توضیحات کامل')->nullable();
            $table->boolean('status')->comment('وضعیت درخواست')->default(0);
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('transfer_id')->references('id')->on('transfers');
            $table->foreign('estate_id')->references('id')->on('estates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
