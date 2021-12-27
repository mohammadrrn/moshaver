<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{

    public static function tooManyRequestsForPasswordReset() // تعداد دفعات تلاش جهت ارسال کد بازیابی کلمه عبور بیشتر از 3 بار شده
    {
        return ['خطای 123 : لطفا با پشتیبانی تماس بگیرید'];
    }

    public static function incorrectResetPasswordCode()
    {
        return ['کد وارد شده اشتباه می باشد'];
    }
}
