<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AssistantController extends Controller
{

    public static function defaultImage()
    {
        return 'default.png';
    }

    public static function defaultThumbnail()
    {
        return 'default-thumbnail.png';
    }


    public static function sendVerificationCode()
    {
        return rand(1000, 9999); // generate rand code
    }

    public static function randomCode()
    {
        return rand(1000, 9999); // generate rand code
    }

    public static function getMacAddress()
    {
        //$MAC = exec('getmac');
        //return strtok($MAC, ' '); // get client mac address
        return 'mac_address';
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
            'toilet' => 'سرویس فرنگی',
            'balcony' => 'تراس',
            'wall_cupboard' => 'کمد دیواری',
            'surface_gas' => 'گاز روکار',
            'master_bath' => 'حمام مستر',
            'jacuzzi' => 'جکوزی',
            'bathtub' => 'وان',
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

    public static function clearSeparator($number)
    {
        $number = explode(',', $number);
        $number = implode($number);
        return self::filterNumber($number);
    }

    public static function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);
    }

    public static function getUserRole()
    {
        return auth()->user()->roles[0]->name;
    }

    public static function userPermissions(): array
    {
        return [
            'update-estate-request',
        ];
    }

    public static function adminPermissions(): array
    {
        return [
            'add-writer', // افزودن نویسنده
            'writer-list', // لیست نویسندگا
            'inactivity-writer', // غیرفعال کردن نویسنده
            'active-writer', // فعال کردن نویسنده
            'edit-writer', // ویرایش نویسنده
            'trusted-offices-list', // لیست دفاتر مورد اعتماد
            'users-list', // لیست کاربران
            'confirm-estate-request',
            'confirmed-estate-request-list',
            'unconfirmed-estate-request-list',
            'update-estate-request',
            'delete-estate-request',
            'confirmed-request-list',
            'unconfirmed-request-list',
            'reject-confirmation-estate-request', // رد تایید آگهی
            'cession-list',
        ];
    }

    public static function writerPermissions(): array
    {
        return [
            'confirm-estate-request', // تایید آگهی ثبت ملک
            'update-estate-request', // ویرایش آگهی ثبت ملک
            'delete-estate-request', // حذف آگهی ثبت ملک
            'confirmed-estate-request-list', // لیست آگهی های ثبت ملک تایید نشده
            'unconfirmed-estate-request-list', // لیست آگهی های ثبت ملک تایید نشده
            'confirm-request', // تایید درخواست
            'unconfirm-request', // رد تایید درخواست
            'update-request', // ویرایش درخواست
            'delete-request', // حذف درخواست
            'confirmed-request-list',// لیست درخواست های تایید شده
            'unconfirmed-request-list', // لیست درخواست تایید نشده
            'reject-confirmation-estate-request', // رد تایید آگهی
            'cession-list', // گزارشات واگذاری
        ];
    }

    public static function goldPermissions()
    {
        return [
            'zoonkan', // زونکن
            'add-reminder', // افزودن یادآوری
            'phonebook' // دفترچه تلفن
        ];
    }

    public static function silverPermissions()
    {
        return [
            'phonebook' // دفترچه تلفن
        ];
    }
}
