@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="top-map">
            <span>صفحه اصلی</span>
            <img src="../icon/PanelAdmin/down.png" alt="">
        </div>
        <div class="row bottom-box-1">
            <div class="col-12 col-md-4">
                <div class="bottom-box-1-box">
                    <div class="bottom-box-1-box-img-top-background"></div>
                    <img class="bottom-box-1-box-img-top" src="../icon/PanelAdmin/icons8_Add_Graph_Report.png"
                         alt="">
                    <span>آگهی های من</span>
                    <div class="bottom-box-1-box-bottom">
                        <span class="bottom-box-1-box-bottom-right">{{$data['myEstateRequest']}}</span>
                        <div class="bottom-box-1-box-bottom-left">
                            <span>آگهی</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="bottom-box-1-box">
                    <div class="bottom-box-1-box-img-top-background"></div>
                    <img class="bottom-box-1-box-img-top" src="../icon/PanelAdmin/icons8-pay-date-50.png" alt="">
                    <span>تاانقضای اشتراک</span>
                    <div class="bottom-box-1-box-bottom">
                        @if($data['subscribeExpiry'] == null)
                            <span class="bottom-box-1-box-bottom-right">
                                شما اشتراکی ندارید
                            </span>
                            <div class="bottom-box-1-box-bottom-left">
                                <a href="{{route('panel.subscription.plans')}}" class="text-white">خرید اشتراک</a>
                            </div>
                        @else
                            <span class="bottom-box-1-box-bottom-right">
                                {{$data['subscribeExpiry']}}
                            </span>
                            <div class="bottom-box-1-box-bottom-left">
                                <span>روز</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="bottom-box-1-box">
                    <div class="bottom-box-1-box-img-top-background"></div>
                    <img class="bottom-box-1-box-img-top" src="{{asset('icon/PanelAdmin/icons8-staff-60.png')}}" alt="">
                    <span>اشتراک پنل شما</span>
                    @if($data['subscribePlan'])
                        <div class="bottom-box-1-box-bottom">
                            <span class="bottom-box-1-box-bottom-right">{{$data['subscribePlan']->plan->title}}</span>
                            <div class="bottom-box-1-box-bottom-left">
                                <span>{{$data['subscribePlan']->item->time}} ماهه </span>
                            </div>
                        </div>
                    @else
                        <div class="bottom-box-1-box-bottom">
                            <span class="bottom-box-1-box-bottom-right">-----</span>
                            <div class="bottom-box-1-box-bottom-left">
                                <span>-----</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <h4 class="title-services">خدمات ما</h4>
        <div class="row">
            <!-- <div class="col-12 col-md-6 col-lg-3">
                <div class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/icons8_staff copy.png" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/icons8_staff-white.png" alt="">
                    <span>
                        ویرایش پروفایل
                    </span>
                </div>
            </div> -->
            <!-- <div class="col-12 col-md-6 col-lg-3">
                <div class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/icons8-add-basket-60.png" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/icons8_Add_Basket.png" alt="">
                    <span>
                        خرید حق اشتراک
                    </span>
                </div>
            </div> -->
            <!-- <div class="col-12 col-md-6 col-lg-3">
                <div class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/icons8-happy-file-64.png" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/icons8-happy-file-64-w.png" alt="">
                    <span>
                        ثبت ملک
                    </span>
                </div>
            </div> -->
            <!-- <div class="col-12 col-md-6 col-lg-3">
                <div class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/icons8-important-file-64.png" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/icons8-important-file-64-w.png" alt="">

                    <span>
                        ثبت درخواست
                    </span>
                </div>
            </div> -->

            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('panel.estateRequest.myEstateRequest')}}" class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/icons8-happy-file-64.png" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/icons8-happy-file-64-w.png" alt="">
                    <span>
                                نمایش ثبت ملک
                            </span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('panel.request.myRequest')}}" class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/icons8-important-file-64.png" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/icons8-important-file-64-w.png" alt="">
                    <span>
                                نمایش  درخواست ها
                            </span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('panel.zoonkan.createZoonkanForm')}}" class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/binder.svg" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/binder-w.svg" alt="">
                    <span>
                                زونکن
                            </span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="services-box">
                    <img class="services-box-img-1" src="../icon/PanelAdmin/video_clip.svg" alt="">
                    <img class="services-box-img-2" src="../icon/PanelAdmin/video_clip-white.svg" alt="">
                    <span>
                                ویدئو آموزشی
                            </span>
                </div>
            </div>


        </div>
        <!-- <h4 class="title-services">گزارش آگهی های شما</h4>
        <div class="row">
            <div class="col-12">
                <canvas id="myChart"></canvas>
            </div>
        </div> -->
    </div>
@endsection
