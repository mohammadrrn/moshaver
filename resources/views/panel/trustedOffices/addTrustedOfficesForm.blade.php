@extends('layouts.app')

@section('title','افزودن دفاتر مورد اعتماد')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="top-map">
            <span>صفحه اصلی</span>
            <img src="{{asset('icon/PanelAdmin/down.png')}}" alt="">
            <span>افزودن املاک</span>
        </div>
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.trustedOffices.addTrustedOffices')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>افزودن املاک</span>
                    </div>
                    <div class="group">
                        <input type="text" name="real_estate_name" value="{{old('real_estate_name')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام املاک</label>
                    </div>
                    <div class="group">
                        <input type="text" name="full_name" value="{{old('full_name')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="national_code" value="{{old('national_code')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کد ملی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="mobile_number" value="{{old('mobile_number')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>
                    <div class="group">
                        <select class="form-select form-select" aria-label="Default select example" name="score">
                            <option selected="" disabled="">امتیاز</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                <!--                    <div class="group">
                        <input type="text" name="email" value="{{old('email')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>ایمیل</label>
                    </div>-->
                    <div class="group">
                        <input type="text" name="address" value="{{old('address')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>آدرس</label>
                    </div>
                <!--                    <div class="group">
                        <input type="text" name="password" value="{{old('password')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کلمه عبور</label>
                    </div>-->
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ثبت دفتر</button>
                </form>
            </div>
            <!--            <div class="col-md-12 col-lg-6 add-moshaver">
                            <div class="form">
                                <div class="form-top">
                                    <span>جستجو کاربر</span>
                                    <img src="../icon/PanelAdmin/ICON.png" alt="">
                                </div>
                                <div class="group">
                                    <input type="text" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>نام املاک</label>
                                </div>
                                <div class="group">
                                    <input type="text" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>نام و نام خانوادگی</label>
                                </div>
                                <div class="group">
                                    <input type="text" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>کد کاربر</label>
                                </div>
                                <div class="group">
                                    <input type="text" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>شماره همراه</label>
                                </div>
                                <div class="group">
                                    <select class="form-select form-select" aria-label="Default select example">
                                        <option selected="" disabled="">امتیاز</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="group">
                                    <input type="text" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>ایمیل</label>
                                </div>
                                <div class="group">
                                    <input type="text" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>آدرس</label>
                                </div>
                                <button type="button" class="btn btn-lg btn-block moshaver-insert">جستجو دفتر</button>
                            </div>
                        </div>-->

            <div class="col-md-12  list-moshaver">
                <div class="row">
                    @foreach($data['trustedOffices'] as $office)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="list-moshaver-item">
                                <div class="add-moshaver-box-specifications">
                                    <span
                                        class="add-moshaver-box-specifications-span-code bg-warning text-black">کد : {{$office->id}}</span>
                                </div>
                                <span>{{$office->real_estate_name}}</span>
                                <span>{{$office->full_name}}</span>
                                <span>{{$office->mobile_number}}</span>
                                <span>{{$office->address}}</span>
                                <div class="add-trusted-offices-star text-center">
                                    <span class="bg-warning p-2">{{$office->score}} ستاره</span>
                                </div>
                                <div class="add-trusted-offices-bottom-button">
                                    <a href="{{route('panel.trustedOffices.updateTrustedOfficesForm',$office->id)}}"
                                       class="btn-block-user">ویرایش</a>
                                </div>
                                <div class="add-trusted-offices-bottom-button">
                                    <a href="{{route('panel.trustedOffices.deleteTrustedOfficesForm',$office->id)}}"
                                       class="btn-block-user">حذف</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
