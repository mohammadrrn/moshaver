@extends('layouts.app')

@section('title','خرید اشتراک')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 subscription">
            <div class="col-12">
                <div class="row subscription-top">
                    <div class="col-12 col-md-6 ">
                        <div class="subscription-top-box">
                            <div class="subscription-top-box-top">
                                <img src="{{asset($data['gold']->icon)}}" alt="">
                                <span>
                                            {{$data['gold']->title}}
                                        </span>
                            </div>
                            <div class="subscription-top-box-center">
                                <span>امکانات این اشتراک :</span>
                                <ul>
                                    @foreach(json_decode($data['gold']->properties) as $property)
                                        <li>
                                            {{$property}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="subscription-top-box-bottom">
                                <button class="btn btn-block btn-choose btn-choose-gold">نمایش طرح ها</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 ">
                        <div class="subscription-top-box">
                            <div class="subscription-top-box-top">
                                <img src="{{asset($data['silver']->icon)}}" alt="">
                                <span>
                                            {{$data['silver']->title}}
                                        </span>
                            </div>
                            <div class="subscription-top-box-center">
                                <span>امکانات این اشتراک :</span>
                                <ul>
                                    @foreach(json_decode($data['silver']->properties) as $property)
                                        <li>
                                            {{$property}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="subscription-top-box-bottom">
                                <button class="btn btn-block btn-choose btn-choose-silver">نمایش طرح ها</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="subscription-center">
                    <div class="subscription-center-gold">
                        @foreach($data['gold']->items as $item)
                            <a href="{{route('panel.pay',[$item->plan_price,$data['gold']->id,$item->id])}}"
                               class="subscription-center-box subscription-center-box-gold">
                                <div>
                                    <span class="subscription-center-box-number">•</span>
                                    <span
                                        class="subscription-center-box-time">{{$data['gold']->title}} {{$item->time}} ماه </span>
                                    <span
                                        class="subscription-center-box-money">{{$item->plan_price}} هزار تومان </span>
                                </div>
                                <span class="subscription-center-box-continue">خرید و ادامه</span>
                            </a>
                        @endforeach
                    </div>


                    <div class="subscription-center-silver">
                        @foreach($data['silver']->items as $item)
                            <a href="{{route('panel.pay',[$item->plan_price,$data['silver']->id,$item->id])}}"
                               class="subscription-center-box subscription-center-box-silver">
                                <div>
                                    <span class="subscription-center-box-number-silver">•</span>
                                    <span
                                        class="subscription-center-box-time">{{$data['silver']->title}} {{$item->time}} ماه </span>
                                    <span class="subscription-center-box-money">{{$item->plan_price}} هزار تومان </span>
                                </div>
                                <span class="subscription-center-box-continue">خرید و ادامه</span>
                            </a>
                        @endforeach
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
