@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <br>
        <div class="row bottom-box-1">
            <div class="col-12 col-md-4">
                <div class="bottom-box-1-box">
                    <div class="bottom-box-1-box-img-top-background"></div>
                    <img class="bottom-box-1-box-img-top" src="{{asset('icon/PanelAdmin/my-ad.svg')}}"
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
                    <img class="bottom-box-1-box-img-top" src="{{asset('icon/PanelAdmin/expire.svg')}}"
                         alt="">
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
                                {{$data['subscribeExpiry']}} روز دیگر
                            </span>
                            <div class="bottom-box-1-box-bottom-left">
                                <span>{{$data['date']}}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="bottom-box-1-box">
                    <div class="bottom-box-1-box-img-top-background"></div>
                    <img class="bottom-box-1-box-img-top" src="{{asset('icon/PanelAdmin/medal.svg')}}" alt="">
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
        @permission('special-link')
        <h4 class="title-services">لینک ویژه شما</h4>
        <div>
            {{route('specialLink',auth()->user()->id)}}
            <button class="btn btn-success btn-sm">کپی کردن</button>
        </div>
        @endpermission
        <h4 class="title-services">خدمات ما</h4>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('panel.estateRequest.myEstateRequest')}}" class="services-box">
                    <img class="services-box-img-1" src="{{asset('icon/PanelAdmin/my-ad.svg')}}" alt="">
                    <img class="services-box-img-2" src="{{asset('icon/PanelAdmin/my-ad-w.svg')}}"
                         alt="">
                    <span>
                                ملک های من
                            </span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('panel.request.myRequest')}}" class="services-box">
                    <img class="services-box-img-1" src="{{asset('icon/PanelAdmin/my-ad.svg')}}"
                         alt="">
                    <img class="services-box-img-2" src="{{asset('icon/PanelAdmin/my-ad-w.svg')}}"
                         alt="">
                    <span>
                                درخواست های من
                            </span>
                </a>
            </div>
            @permission('zoonkan')
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('panel.zoonkan.createZoonkanForm')}}" class="services-box">
                    <img class="services-box-img-1" src="{{asset('icon/PanelAdmin/binder.svg')}}" alt="">
                    <img class="services-box-img-2" src="{{asset('icon/PanelAdmin/binder-w.svg')}}" alt="">
                    <span>
                                زونکن
                            </span>
                </a>
            </div>
            @endpermission
            @permission('educational-video')
            <div class="col-12 col-md-6 col-lg-3">
                <div class="services-box">
                    <img class="services-box-img-1" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
                    <img class="services-box-img-2" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
                    <span>
                                ویدئو آموزشی
                            </span>
                </div>
            </div>
            @endpermission
        </div>
    </div>
@endsection
