<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->comment('نام و نام خانوادگی');
            $table->string('mobile_number', 11)->comment('شماره همراه');
            $table->string('national_code')->comment('کد ملی')->nullable();
            $table->string('email')->comment('ایمیل')->nullable();
            $table->string('password')->comment('کلمه عبور');
            $table->string('address')->comment('آدرس')->nullable();
            $table->unsignedBigInteger('area_id')->comment('آیدی منطقه برای نویسنده')->nullable();
            $table->boolean('status')->comment('وضعیت کاربر')->default(0);
            $table->string('reason_for_blocking')->comment('علت مسدودی')->nullable();
            $table->boolean('profileStatus')->comment('وضعیت پروفایل کاربر')->default(0);
            $table->string('mac_address')->comment('مک آدرس');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
