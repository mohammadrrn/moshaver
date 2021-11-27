@extends('index')

@section('title','ثبت ملک')

@section('content')
    <main class="container-fluid">
        <div class="cover-back-send-product"> </div>
        <div class="container main-box-top">
            <form class="row send-product" method="post" action="{{route('request.estate')}}">
                @csrf
                <div class="col-12 titr">
                    <div>ثبت ملک</div>
                    <br>
                    @if(session('success'))
                        {{session('success')}}
                    @endif
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <span>
                        نوع واگذاری
                    </span>
                    <select name="transfer_id" class="view-order-select ddlViewBy " aria-label="Default select example">
                        <option disabled selected>انتخاب نوع واگذاری</option>
                        @foreach($data['transfer'] as $transfer)
                            <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <span>
                        نوع ملک
                    </span>
                    <select name="estate_id" class="view-order-select" aria-label="Default select example">
                        <option disabled selected>انتخاب نوع ملک</option>
                        @foreach($data['estate'] as $estate)
                            <option value="{{$estate->id}}">{{$estate->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="area" value="{{old('area')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>متراژ</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <span>
                        منطقه
                    </span>
                    <select name="area_id" class="view-order-select" aria-label="Default select example">
                        <option selected disabled>انتخاب منطقه</option>
                        @foreach($data['area'] as $area)
                            <option value="{{$area->id}}">{{$area->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 view-order">
                    <div class="group">
                        <input type="text" name="address" value="{{old('address')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>آدرس</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="street_name" value="{{old('street_name')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام کوچه و خیابان</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="plaque" value="{{old('plaque')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>پلاک</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="owner_name" value="{{old('owner_name')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام مالک</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="owner_mobile_number" value="{{old('owner_mobile_number')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>
                </div>
                <div id="box-by" class="col-12 view-order">
                    <div class="group">
                        <input type="text" id="buy_price" name="buy_price" value="{{old('buy_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ خرید</label>
                    </div>
                </div>
                <div id="box-mortgage" class="col-12 view-order">
                    <div class="group">
                        <input type="text" id="mortgage_price" name="mortgage_price" value="{{old('mortgage_price')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ رهن</label>
                    </div>
                </div>
                <div id="box-rent" class="col-12 view-order">
                    <div class="group">
                        <input type="text" name="rent_price" id="rent_price" value="{{old('rent_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ اجاره</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="floor" value="{{old('floor')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>طبقه</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="number_of_floor" value="{{old('number_of_floor')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تعداد طبقه</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="apartment_unit" value="{{old('apartment_unit')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تعداد واحد</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="number_of_room" value="{{old('number_of_room')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تعداد اتاق</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="year_of_construction" value="{{old('year_of_construction')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>سال ساخت</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-md-6 view-order">
                    <span>
                        جهت ملک
                    </span>
                    <select name="direction_id" class="view-order-select" aria-label="Default select example">
                        <option disabled selected>انتخاب جهت ساختمان</option>
                        @foreach($data['direction'] as $direction)
                            <option value="{{$direction->id}}">{{$direction->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 view-order">
                    <div class="group">
                        <input type="text" name="description" value="{{old('description')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>توضیحات</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row send-request-user-group-option">
                        <div class="col-12">
                            <span>
                                امکانات ملک
                            </span>
                        </div>
                        @foreach(\App\Http\Controllers\AssistantController::estateRequestOptions() as $item =>$value)
                            <div class="col-12 col-md-3 ">
                                <div class="send-request-user-group-option-box group-option-box">
                                    <input value="1" type="checkbox" id="option_{{$item}}" name="{{$item}}">
                                    <label for="option_{{$item}}">
                                        {{$value}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="box-theree">
                    <img class="box-theree-1" src="{{asset('icon/icons8_camera_26px.png')}}" alt="">
                </div>
                <button class="btn insert-btn" type="submit">ثبت فایل</button>
            </form>
        </div>


    </main>
@endsection
