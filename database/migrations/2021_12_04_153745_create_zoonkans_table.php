<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoonkansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoonkans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('آیدی کاربر');
            $table->string('zoonkan_name')->comment('نام زونکن');
            $table->string('zoonkan_color')->comment('رنگ زونکن');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoonkans');
    }
}
