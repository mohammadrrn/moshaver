<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_requests', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name')->comment('نام و نام خانوادگی مالک');
            $table->string('owner_mobile_number', 11)->comment('شماره همراه مالک');
            $table->unsignedBigInteger('area_id')->comment('آیدی منطقه')->nullable();
            $table->unsignedBigInteger('transfer_id')->comment('آیدی نوع واگذاری');
            $table->unsignedBigInteger('estate_id')->comment('آیدی نوع ملک');
            $table->string('address')->comment('آدرس');
            $table->string('area')->comment('متراژ');
            $table->string('street_name')->comment('نام کوچه و خیابان');
            $table->unsignedSmallInteger('plaque')->comment('پلاک');
            $table->unsignedInteger('floor')->comment('طبقه')->nullable();
            $table->unsignedInteger('number_of_floor')->comment('تعداد طبقه');
            $table->unsignedInteger('number_of_room')->comment('تعداد اتاق')->nullable()->default(0);
            $table->unsignedInteger('apartment_unit')->comment('تعداد واحد')->nullable();
            $table->unsignedInteger('year_of_construction')->comment('سال ساخت')->nullable();
            $table->unsignedBigInteger('direction_id')->comment('آیدی جهت ملک')->nullable();
            $table->unsignedBigInteger('mortgage_price')->comment('مبلغ رهن')->nullable()->default(0);
            $table->unsignedBigInteger('rent_price')->comment('مبلغ اجاره')->nullable()->default(0);
            $table->unsignedBigInteger('buy_price')->comment('مبلغ خرید')->nullable()->default(0);
            $table->text('description')->comment('توضیحات کامل')->nullable();
            $table->boolean('status')->comment('وضعیت')->default(0);

            $table->boolean('empty')->comment('امکانات (تخلیه)')->default(0)->nullable();
            $table->boolean('presell')->comment('امکانات (پیش فروش)')->default(0)->nullable();
            $table->boolean('exchange')->comment('امکانات (معاوضه)')->default(0)->nullable();
            $table->boolean('parking')->comment('امکانات (پارکینگ)')->default(0)->nullable();
            $table->boolean('warehouse')->comment('امکانات (انباری)')->default(0)->nullable();
            $table->boolean('elevator')->comment('امکانات (آسانسور)')->default(0)->nullable();
            $table->boolean('electric_door')->comment('امکانات (درب برقی)')->default(0)->nullable();
            $table->boolean('iphone_video')->comment('امکانات (آیفون تصویری)')->default(0)->nullable();
            $table->boolean('toilet')->comment('امکانات (دستشویی)')->default(0)->nullable();
            $table->boolean('balcony')->comment('امکانات (بالکن)')->default(0)->nullable();
            $table->boolean('wall_cupboard')->comment('امکانات (کمد دیواری)')->default(0)->nullable();
            $table->boolean('surface_gas')->comment('امکانات (گاز روکار)')->default(0)->nullable();
            $table->boolean('master_bath')->comment('امکانات (حمام مستر)')->default(0)->nullable();
            $table->boolean('jacuzzi')->comment('امکانات (جکوزی)')->default(0)->nullable();
            $table->boolean('security_door')->comment('امکانات (درب ضد سرقت)')->default(0)->nullable();
            $table->boolean('cctv')->comment('امکانات (دوربین مداربسته)')->default(0)->nullable();
            $table->boolean('presence_owner')->comment('امکانات (حضور مالک)')->default(0)->nullable();
            $table->boolean('convertable')->comment('امکانات (قابل تبدیل)')->default(0)->nullable();
            $table->boolean('rebuilt')->comment('امکانات (باز سازی شده)')->default(0)->nullable();
            $table->boolean('no_owner')->comment('امکانات (بدون مالک)')->default(0)->nullable();
            $table->boolean('full_authority')->comment('امکانات (اختیار کامل)')->default(0)->nullable();
            $table->boolean('separate_way')->comment('امکانات (راه مجزا)')->default(0)->nullable();
            $table->boolean('single_type')->comment('امکانات (مجردی)')->default(0)->nullable();
            $table->boolean('flat')->comment('امکانات (فلت)')->default(0)->nullable();
            $table->boolean('barbecue')->comment('امکانات (باربیکیو)')->default(0)->nullable();
            $table->boolean('unit_zero')->comment('امکانات (واحد صفر)')->default(0)->nullable();
            $table->boolean('roof_garden')->comment('امکانات (روف گاردن)')->default(0)->nullable();

            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('transfer_id')->references('id')->on('transfers');
            $table->foreign('estate_id')->references('id')->on('estates');
            $table->foreign('direction_id')->references('id')->on('directions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_requests');
    }
}
