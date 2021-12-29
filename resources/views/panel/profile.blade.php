@extends('layouts.app')

@section('title','ویرایش پروفایل')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="top-map">
            <span>صفحه اصلی</span>
            <img src="../icon/PanelAdmin/down.png" alt="">
            <span>ویرایش پروفایل</span>
        </div>
        <div class="row bottom-box-1 user">
            <div class="col-12">
                        <span class="title-services">
                            مشخصات من
                        </span>
            </div>
            <div class="col-12">
                <form action="{{route('panel.updateProfile')}}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row user-top">
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" name="full_name" required value="{{auth()->user()->full_name}}"/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>نام</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" name="national_code" required
                                       value="{{auth()->user()->national_code}}"/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>کد ملی</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" disabled name="mobile_number"
                                       value="{{auth()->user()->mobile_number}}"/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" name="email" required value="{{auth()->user()->email}}"/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>ایمیل</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" name="address" value="{{auth()->user()->address}}"/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>آدرس</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <button type="submit" class="btn btn-block"> ویرایش اطلاعات</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 user-box-center">
                        <span class="title-services">
                            تغییر رمز عبور
                        </span>
            </div>
            <div class="col-12">
                <form action="{{route('panel.changePassword')}}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row user-top">
                        <div class="col-12  user-view-order">
                            <div class="group">
                                <input type="password" name="old_password" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>رمز عبور فعلی</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" name="new_password" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>رمز عبور جدید</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <div class="group">
                                <input type="text" required name="password_confirmation"/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>تکرار رمز عبور جدید</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 user-view-order">
                            <button type="submit" class="btn btn-block">ذخیره تغییرات</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
