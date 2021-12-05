@extends('layouts.app')

@section('title','ویرایش دفاتر مورد اعتماد')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="top-map">
            <span>صفحه اصلی</span>
            <img src="{{asset('icon/PanelAdmin/down.png')}}" alt="">
            <span>ویرایش املاک</span>
        </div>
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.trustedOffices.updateTrustedOffices',$data['trustedOffice']->id)}}"
                      class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>ویرایش املاک</span>
                    </div>
                    <div class="group">
                        <input type="text" name="real_estate_name"
                               value="{{$data['trustedOffice']->real_estate_name}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام املاک</label>
                    </div>
                    <div class="group">
                        <input type="text" name="full_name" value="{{$data['trustedOffice']->full_name}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="national_code" value="{{$data['trustedOffice']->national_code}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کد ملی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="mobile_number" value="{{$data['trustedOffice']->mobile_number}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>
                    <div class="group">
                        <select class="form-select form-select" aria-label="Default select example" name="score">
                            <option selected disabled="">امتیاز</option>
                            @for($i=1;$i<=5;$i++)
                                @if($data['trustedOffice']->score == $i)
                                    <option selected value="{{$i}}">{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>

                    <div class="group">
                        <input type="text" name="address" value="{{$data['trustedOffice']->address}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>آدرس</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ویرایش</button>
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

        </div>
    </div>
@endsection
