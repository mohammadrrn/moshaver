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
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                    @if($errors->all())
                        <br>
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <span class="small">{{$error}}</span><br>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="full_name" value="{{old('full_name')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="mobile_number" maxlength="11" value="{{old('mobile_number')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order city">
                    <span>
                        منطقه
                    </span>
                    <select name="area_id" class="view-order-select" aria-label="Default select example">
                        <option disabled selected>انتخاب منطقه</option>
                        @foreach($data['area'] as $area)
                            @if(old('area_id') == $area->id)
                                <option selected value="{{$area->id}}">{{$area->text}}</option>
                            @else
                                <option value="{{$area->id}}">{{$area->text}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 view-order city">
                    <span>
                        نوع واگذاری
                    </span>
                    <input type="hidden" class="transfer_id"
                           value="{{old('type_of_transfer')}}">
                    <select name="type_of_transfer" class="view-order-select ddlViewBy" id="transfer"
                            aria-label="Default select example">
                        <option disabled selected>انتخاب نوع واگذاری</option>
                        @foreach($data['transfer'] as $transfer)
                            @if(old('type_of_transfer') == $transfer->id)
                                <option selected value="{{$transfer->id}}">{{$transfer->text}}</option>
                            @else
                                <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 view-order city">
                    <span>
                        نوع ملک
                    </span>
                    <div>
                        <select name="type_of_estate" class="view-order-select"
                                aria-label="Default select example">
                            <option disabled selected>انتخاب نوع ملک</option>
                            @foreach($data['estate'] as $estate)
                                @if(old('type_of_estate') == $estate->id)
                                    <option selected value="{{$estate->id}}">{{$estate->text}}</option>
                                @else
                                    <option value="{{$estate->id}}">{{$estate->text}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
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
                <div id="buy_price" class="col-12 view-order number-separator price">
                    <div class="group">
                        <input type="text" name="buy_price" value="{{old('buy_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ خرید (تومان)</label>
                    </div>
                </div>
                <div id="mortgage_price" class="col-12 col-md-6 view-order number-separator price">
                    <div class="group">
                        <input type="text" name="mortgage_price" value="{{old('mortgage_price')}}"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ رهن (تومان)</label>
                    </div>
                </div>
                <div id="rent_price" class="col-12 col-md-6 view-order number-separator price">
                    <div class="group">
                        <input type="text" name="rent_price" value="{{old('rent_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ اجاره (تومان)</label>
                    </div>
                </div>
                <div id="participation_price" class="col-12 col-md-6 view-order number-separator price">
                    <div class="group">
                        <input type="text" name="participation_price" value="{{old('participation_price')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>مبلغ مشارکت (تومان)</label>
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
                {!! NoCaptcha::display() !!}
                <button type="submit" class="btn insert-btn m-3">ثبت درخواست</button>
            </form>
        </div>
    </main>
@endsection


@section('js')
    {!! NoCaptcha::renderJs() !!}
@endsection
