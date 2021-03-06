<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoonkanFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoonkan_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zoonkan_id')->comment('آیدی زونکن');
            $table->unsignedBigInteger('estate_request_id')->comment('آیدی درخواست');
            $table->unsignedBigInteger('user_id')->comment('آیدی کاربر');
            $table->timestamp('evacuation_day')->comment('تعداد روز های باقی مانده تا تخلیه');
            $table->timestamps();

            $table->foreign('zoonkan_id')->references('id')->on('zoonkans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estate_request_id')->references('id')->on('estate_requests')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoonkan_file');
    }
}
