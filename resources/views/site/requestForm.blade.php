@extends('index')

@section('title','ثبت درخواست')

@section('content')
    <main class="container-fluid">
        <div class="cover-back-send-product"> </div>
        <div class="container main-box-top">
            <form method="post" action="{{route('request.request')}}" class="row send-product send-product-user">
                @csrf
                <div class="col-12 titr">
                    <span>ثبت درخواست</span>
                    <br>
                    @if(session('success'))
                        {{session('success')}}
                    @endif
                    @foreach($errors->all() as $error)
                        {{$error}}<br>
                    @endforeach
                </div>
                <div class="col-12 view-order">
                    <div class="group">
                        <input type="text" name="full_name" value="{{old('full_name')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                </div>
                <div class="col-12 view-order">
                    <div class="group">
                        <input type="text" name="mobile_number" value="{{old('mobile_number')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>
                </div>
                <div class="col-12 view-order city">
                    <span>
                        منطقه
                    </span>
                    <select name="area_id" class="view-order-select" aria-label="Default select example">
                        <option disabled selected>انتخاب منطقه</option>
                        @foreach($data['area'] as $area)
                            <option value="{{$area->id}}">{{$area->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 view-order city">
                    <span>
                        نوع واگذاری
                    </span>
                    <select name="type_of_transfer" class="view-order-select ddlViewBy"
                            aria-label="Default select example">
                        <option disabled selected>انتخاب نوع واگذاری</option>
                        @foreach($data['transfer'] as $transfer)
                            <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 view-order city">
                    <span>
                        نوع ملک
                    </span>
                    <div>
                        <select name="type_of_estate" class="view-order-select"
                                aria-label="Default select example">
                            <option disabled selected>انتخاب نوع ملک</option>
                            @foreach($data['estate'] as $estate)
                                <option value="{{$estate->id}}">{{$estate->text}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 view-order">
                    <div class="group">

                        <input type="text" name="range_of_address" value="{{old('range_of_address')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>حدود آدرس</label>
                    </div>
                </div>

                <div class="col-12 view-order">
                    <div class="group">

                        <input type="text" name="rang_of_area" value="{{old('rang_of_area')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>حدود متراژ درخواستی </label>
                    </div>
                </div>
                <div id="box-by" class="col-12 view-order number-separator">
                    <div class="group">
                        <input id="buy_price" type="text" name="buy_price" value="{{old('buy_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ خرید</label>
                    </div>
                </div>
                <div id="box-mortgage" class="col-12 view-order number-separator">
                    <div class="group">
                        <input type="text" id="mortgage_price" name="mortgage_price" value="{{old('mortgage_price')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ رهن</label>
                    </div>
                </div>

                <div id="box-rent" class="col-12 view-order number-separator">
                    <div class="group">

                        <input type="text" name="rent_price" id="rent_price" value="{{old('rent_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ اجاره</label>
                    </div>
                </div>
                <div class="col-12 view-order">
                    <div class="group">
                        <input type="text" name="description" value="{{old('description')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>توضیحات</label>
                    </div>
                </div>


                <!--                <div class="col-12">
                                    <iframe
                                        width="100%"
                                        height="300"
                                        style="border:0"
                                        loading="lazy"
                                        allowfullscreen
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d803.9581469254231!2d59.648435570803976!3d36.292111779697215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c919f28d0eef9%3A0xd77646c62e69afdc!2z2qnbjNmBINmIINqp2YHYtCDYotix2qnYpw!5e0!3m2!1sfa!2sus!4v1625319036294!5m2!1sfa!2sus">
                                    </iframe>
                                </div>-->
                <button type="submit" class="btn insert-btn m-3">ثبت درخواست</button>
            </form>
        </div>
    </main>
@endsection
