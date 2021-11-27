<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public static function sendVerificationCode()
    {
        return rand(1000, 9999); // generate rand code
    }

    public static function getMacAddress()
    {
        //$MAC = exec('getmac');
        //return strtok($MAC, ' '); // get client mac address
    }

    public static function estateRequestOptions()
    {
        return [
            'empty' => 'تخلیه',
            'presell' => 'پیش فروش',
            'exchange' => 'معاوضه',
            'parking' => 'پارکینگ',
            'warehouse' => 'انباری',
            'elevator' => 'آسانسور',
            'electric_door' => 'درب برقی',
            'iphone_video' => 'آیفون تصویری',
            'toilet' => 'دستشویی',
            'balcony' => 'بالکن',
            'wall_cupboard' => 'کمد دیواری',
            'surface_gas' => 'گاز روکار',
            'master_bath' => 'حمام مستر',
            'jacuzzi' => 'جکوزی',
            'security_door' => 'درب ضد سرقت',
            'cctv' => 'دوربین مداربسته',
            'presence_owner' => 'حضور مالک',
            'convertable' => 'قابل تبدیل',
            'rebuilt' => 'باز سازی شده',
            'no_owner' => 'بدون مالک',
            'full_authority' => 'اختیار کامل',
            'separate_way' => 'راه مجزا',
            'single_type' => 'مجردی',
            'flat' => 'فلت',
            'barbecue' => 'باربیکیو',
            'unit_zero' => 'واحد صفر',
            'roof_garden' => 'روف گاردن',
        ];
    }

    public static function filterNumber($number) // this function converted persian numbers to english number
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $number);
        return str_replace($arabic, $num, $convertedPersianNums);
    }
}
