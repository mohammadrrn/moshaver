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
            $table->id()->from(4000);
            $table->string('owner_name')->comment('نام و نام خانوادگی مالک')->nullable();
            $table->string('owner_mobile_number', 11)->comment('شماره همراه مالک');
            $table->unsignedBigInteger('user_id')->comment('آیدی کاربر')->nullable();
            $table->string('image')->comment('عکس با کیفیت آگهی')->nullable();
            $table->string('thumbnail')->comment('تامبنیل عکس آگهی')->nullable();
            $table->text('sliders')->comment('عکس های اسلایدر')->nullable();
            $table->unsignedBigInteger('area_id')->comment('آیدی منطقه')->nullable();
            $table->unsignedBigInteger('transfer_id')->comment('آیدی نوع واگذاری')->nullable();
            $table->unsignedBigInteger('estate_id')->comment('آیدی نوع ملک')->nullable();
            $table->string('address')->comment('آدرس')->nullable();
            $table->string('area')->comment('متراژ')->default(0);
            $table->string('street_name')->comment('نام کوچه و خیابان')->nullable();
            $table->string('plaque')->comment('پلاک')->default(0);
            $table->string('floor')->comment('طبقه')->default(0);
            $table->string('number_of_floor')->comment('تعداد طبقه')->default(0);
            $table->string('number_of_room')->comment('تعداد اتاق')->default(0);
            $table->string('apartment_unit')->comment('تعداد واحد')->default(0);
            $table->string('year_of_construction')->comment('سال ساخت')->default(0);
            $table->unsignedBigInteger('direction_id')->comment('آیدی جهت ملک')->nullable();
            $table->string('mortgage_price')->comment('مبلغ رهن')->nullable()->default(0);
            $table->string('rent_price')->comment('مبلغ اجاره')->nullable()->default(0);
            $table->string('buy_price')->comment('مبلغ خرید')->nullable()->default(0);
            $table->string('participation_price')->comment('مبلغ مشارکت')->nullable()->default(0);
            $table->text('description')->comment('توضیحات کامل')->nullable();
            $table->boolean('status')->comment('وضعیت')->default(0);
            $table->text('reason')->comment('دلیل رد تایید آگهی')->default('')->nullable();

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
            $table->boolean('bathtub')->comment('امکانات (وان)')->default(0)->nullable();
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

            $table->unsignedBigInteger('floor_covering_id')->comment('امکانات (نوع کف پوش)')->nullable();
            $table->unsignedBigInteger('cabinets_id')->comment('امکانات (نوع کابینت)')->nullable();
            $table->unsignedBigInteger('wall_plugs_id')->comment('امکانات (نوع دیوارپوش)')->nullable();
            $table->unsignedBigInteger('building_facades_id')->comment('امکانات (نوع نما)')->nullable();
            $table->unsignedBigInteger('heating_system_id')->comment('امکانات (نوع سیستم گرمایش)')->nullable();
            $table->unsignedBigInteger('cooling_system_id')->comment('امکانات (نوع سیستم سرمایش)')->nullable();
            $table->unsignedBigInteger('document_type_id')->comment('امکانات (نوع سند)')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('transfer_id')->references('id')->on('transfers');
            $table->foreign('estate_id')->references('id')->on('estates');
            $table->foreign('direction_id')->references('id')->on('directions');

            $table->foreign('floor_covering_id')->references('id')->on('estate_request_floor_covering_option');
            $table->foreign('cabinets_id')->references('id')->on('estate_request_cabinets_option');
            $table->foreign('wall_plugs_id')->references('id')->on('estate_request_wall_plugs_option');
            $table->foreign('building_facades_id')->references('id')->on('estate_request_building_facades_option');
            $table->foreign('heating_system_id')->references('id')->on('estate_request_heating_system_option');
            $table->foreign('cooling_system_id')->references('id')->on('estate_request_cooling_system_option');
            $table->foreign('document_type_id')->references('id')->on('estate_request_document_type_option');

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
