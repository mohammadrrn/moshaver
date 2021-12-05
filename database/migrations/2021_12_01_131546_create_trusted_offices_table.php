<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrustedOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trusted_offices', function (Blueprint $table) {
            $table->id();
            $table->string('real_estate_name')->comment('نام مشاور املاک')->nullable();
            $table->string('full_name')->comment('نام و نام خانوادگی');
            $table->string('national_code')->comment('کد ملی')->nullable();
            $table->string('mobile_number', 11)->comment('شماره همراه');
            $table->unsignedTinyInteger('score')->comment('امتیاز مشاور املاک')->default(0)->nullable();
            $table->string('address')->comment('آدرس')->nullable();
            $table->boolean('status')->comment('وضعیت کاربر')->default(0);
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
        Schema::dropIfExists('trusted_offices');
    }
}
