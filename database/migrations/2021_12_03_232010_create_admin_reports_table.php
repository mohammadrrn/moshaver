<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('number_of_estate_requests')->comment('تعداد درخواست های ثبت ملک');
            $table->unsignedBigInteger('number_of_requests')->comment('تعداد درخواست ها');
            $table->unsignedBigInteger('number_of_users')->comment('تعداد کاربران');
            $table->unsignedBigInteger('number_of_trusted_offices')->comment('تعداد دفاتر مورد اعتماد');
            $table->unsignedBigInteger('number_of_writer')->comment('تعداد نویسندگان');
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
        Schema::dropIfExists('admin_reports');
    }
}
