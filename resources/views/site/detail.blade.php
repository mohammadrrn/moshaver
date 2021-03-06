@extends('index')

@section('title','جزئیات آگهی')

@section('content')
    <main class="container-fluid">
        <a href="{{route('index')}}" class=" back-detile">
            <img src="{{asset('icon/icons8_forward_32px_1.png')}}">
            <span>بازگشت</span>
        </a>
        <div class="detile-box-slider">
            <div class="row">
                <div class="col-12 col-lg-6 ">
                    <div class="detile-box-slider-right">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            @if($data['detail']->status == 2)
                                <div class="ribbon"><span>واگذار شد</span></div>
                            @endif
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                @if($data['detail']->sliders != '')
                                    @foreach(json_decode($data['detail']->sliders) as $key=>$slider)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key+1}}"></li>
                                    @endforeach
                                @endif
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{asset($data['detail']->image)}}"
                                         alt="First slide">
                                </div>
                                @if($data['detail']->sliders != '')
                                    @foreach(json_decode($data['detail']->sliders) as $key=>$slider)
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset($slider)}}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                <!--                    <div class="detile-box-slider-img">
                        <div class="detile-box-slider-img-box">
                            <img src="{{asset('img/img-slider.png')}}">
                            <img class="detile-box-slider-img-box-back"
                                 src="{{asset('icon/detile-back-img-item.png')}}">
                        </div>
                        <div class="detile-box-slider-img-box">
                            <img src="{{asset('img/img-slider.png')}}">
                            <img class="detile-box-slider-img-box-back"
                                 src="{{asset('icon/detile-back-img-item.png')}}">
                        </div>
                        <div class="detile-box-slider-img-box">
                            <img src="{{asset('img/img-slider.png')}}">
                            <img class="detile-box-slider-img-box-back"
                                 src="{{asset('icon/detile-back-img-item.png')}}">
                        </div>
                    </div>-->
                </div>

                <div class="col-12 col-lg-6">
                    <div class="detile-specifications-box">
                        <div class="detile-specifications-top-1">
                            <span>کد ملک : {{$data['detail']->id}}</span>
                            <span
                                class="detile-specifications-top-1-time">{{$data['detail']->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="detile-specifications-top-2">
                            @if($data['detail']->rent_price != 0 && $data['detail']->mortgage_price != 0)
                                <div class="detile-specifications-top-2-right">
                                    <p>رهن : {{number_format($data['detail']->mortgage_price)}} هزار تومان </p>
                                    <p>اجاره : {{number_format($data['detail']->rent_price)}} هزار تومان </p>
                                </div>
                            @elseif($data['detail']->rent_price == 0 && $data['detail']->mortgage_price != 0)
                                <div class="detile-specifications-top-2-right">
                                    <p>رهن کامل : {{number_format($data['detail']->mortgage_price)}} هزار تومان </p>
                                </div>
                            @elseif($data['detail']->participation_price != 0)
                                <div class="detile-specifications-top-2-right">
                                    <p>مشارکت به مبلغ : {{number_format($data['detail']->participation_price)}} هزار
                                        تومان </p>
                                </div>
                            @elseif($data['detail']->buy_price != 0 && $data['detail']->mortgage_price == 0)
                                <div class="box-sell-bottom-bottom-right-item">
                                    <span>خرید:</span>
                                    <span>{{number_format($data['detail']->buy_price)}} هزار تومان </span>
                                </div>
                            @endif
                            <div class="detile-specifications-top-2-left">
                            <!--                                <img src="{{asset('icon/error.svg')}}">-->
                                @isset($data['detail']->bookmark)
                                    <img class="marked" id="mark_{{$data['detail']->id}}"
                                         aria-valuetext="{{$data['detail']->id}}"
                                         src="{{asset('icon/marked.png')}}">
                                @else
                                    <img class="marked" id="mark_{{$data['detail']->id}}"
                                         aria-valuetext="{{$data['detail']->id}}"
                                         src="{{asset('icon/mark-icon.png')}}">
                            @endisset
                            <!--                                <img src="{{asset('icon/share.svg')}}">-->
                            </div>
                        </div>
                        <div class="detile-specifications-top-3">
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/male_user.svg')}}">
                                <span>
                                    @if($data['detail']->status == 2)
                                        ------
                                    @elseif(!auth()->user() || !auth()->user()->isAbleTo('show-detail-info'))
                                        @isset($data['custom-info'])
                                            نام مشاور : {{$data['custom-info']->full_name}}
                                        @else
                                            اشتراک ندارید
                                        @endisset

                                    @else
                                        نام مالک : {{$data['detail']->owner_name}}
                                    @endif
                                </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/phone.svg')}}">
                                </span>
                                @if($data['detail']->status == 2)
                                    ------
                                @elseif(!auth()->user() || !auth()->user()->isAbleTo('show-detail-info'))
                                    @isset($data['custom-info'])
                                        شماره تماس مشاور : {{$data['custom-info']->mobile_number}}
                                    @else
                                        اشتراک ندارید
                                    @endisset
                                @else
                                    شماره تماس : {{$data['detail']->owner_mobile_number}}
                                @endif
                                <span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/apartment_icon.svg')}}">
                                <span>نوع ملک : {{$data['detail']->estateType[0]->text}}</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/planner.svg')}}">
                                <span>سال ساخت : {{$data['detail']->year_of_construction}} </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/address.svg')}}">
                                <span>
                                    @if($data['detail']->status == 2)
                                        ------
                                    @elseif(!auth()->user() || !auth()->user()->isAbleTo('show-detail-info'))
                                        اشتراک ندارید
                                    @else
                                        آدرس : {{$data['detail']->address.' - '. $data['detail']->street_name}}
                                    @endif
                                </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/sleeping_in_bed.svg')}}">
                                @if($data['detail']->floor == 100)
                                    <span>طبقه فروش : کل</span>
                                @else
                                    <span>طبقه برای فروش  :{{$data['detail']->floor}}</span>
                                @endif
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/sleeping_in_bed.svg')}}">
                                <span>تعداد طبقات : {{$data['detail']->floor}} </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/sleeping_in_bed.svg')}}">
                                <span>تعداد واحد : {{$data['detail']->apartment_unit}}</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/sleeping_in_bed.svg')}}">
                                <span>تعداد خواب : {{$data['detail']->number_of_room}}</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/icons8_surface_1.svg')}}">
                                <span>متراژ : {{$data['detail']->area}} متر </span>
                            </div>
                        </div>

                        <div class="detile-specifications-top-4">
                            <div class="row">
                                <h5 class="col-12">
                                    امکانات ملک
                                </h5>
                                @isset($data['detail']->floorCovering[0])
                                    <span
                                        class="col-12 col-md-6"> کف پوش : {{$data['detail']->floorCovering[0]->text}}</span>
                                @endisset
                                @isset($data['detail']->cabinets[0])
                                    <span
                                        class="col-12 col-md-6"> کابینت : {{$data['detail']->cabinets[0]->text}}</span>
                                @endisset
                                @isset($data['detail']->wallPlugs[0])
                                    <span
                                        class="col-12 col-md-6"> دیوارپوش : {{$data['detail']->wallPlugs[0]->text}}</span>
                                @endisset
                                @isset($data['detail']->buildingFacades[0])
                                    <span
                                        class="col-12 col-md-6">نما : {{$data['detail']->buildingFacades[0]->text}}</span>
                                @endisset
                                @isset($data['detail']->heatingSystem[0])
                                    <span
                                        class="col-12 col-md-6">سیستم گرمایش : {{$data['detail']->heatingSystem[0]->text}}</span>
                                @endisset
                                @isset($data['detail']->coolingSystem[0])
                                    <span
                                        class="col-12 col-md-6">سیستم سرمایش : {{$data['detail']->coolingSystem[0]->text}}</span>
                                @endisset
                                @isset($data['detail']->documentType[0])
                                    <span
                                        class="col-12 col-md-6">نوع سند : {{$data['detail']->documentType[0]->text}}</span>
                                @endisset
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="col-12">
                                    تجهیزات ملک
                                </h5>
                                @foreach(\App\Http\Controllers\AssistantController::estateRequestOptions() as $item=>$value)
                                    @if($data['detail']->$item == 1)
                                        <span class="col-12 col-md-6">✓ {{$value}}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                        @role('admin')
                        <div class="detile-specifications-top-5">
                            @if($errors->all())
                                <div class="alert alert-danger" role="alert">
                                    @foreach($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{session('success')}}
                                </div>
                            @endif
                            <form method="post" class="detile-specifications-box-5-form"
                                  action="{{route('panel.zoonkan.addToZoonkan')}}">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" name="file_id" value="{{$data['detail']->id}}">
                                    <div class="col-12 col-md-6">
                                        <div>
                                            <input type="number" min="0" placeholder="چند روز تا تخلیه باقی مانده ؟"
                                                   name="evacuation_day" class="evacuation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="zoonkan_id">
                                            <option selected disabled>انتخاب زونکن</option>
                                            @foreach($data['zoonkan'] as $zoonkan)
                                                <option value="{{$zoonkan->id}}">{{$zoonkan->zoonkan_name}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="detile-specifications-top-5-button">افزودن به زونکن
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <a class="detile-specifications-top-5-button"
                               href="{{route('panel.estateRequest.updateEstateRequestForm',$data['detail']->id)}}">ویرایش</a>
                            @if($data['detail']->status != 2)
                                <a href="{{route('panel.cession.report',$data['detail']->id)}}"
                                   class="detile-specifications-top-5-button">گزارش واگذاری این ملک</a>
                            @endif
                        </div>
                        @endability
                        <!-- <div class="detile-specifications-top-5">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3214.4610433689813!2d59.532980085185926!3d36.325374501983696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c93524bf508ff%3A0xf775bb8542df3e74!2z2YHZhtin2YjYsduMINin2LfZhNin2LnYp9iqINmIINix2LPYp9mG2Ycg2YHYsdmH2Ybar9uMINmI2YTbjNi52LXYsQ!5e0!3m2!1sfa!2s!4v1591458001424!5m2!1sfa!2s" width="100%" height="330" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            <iframe
                                width="100%"
                                height="200"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d803.9581469254231!2d59.648435570803976!3d36.292111779697215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c919f28d0eef9%3A0xd77646c62e69afdc!2z2qnbjNmBINmIINqp2YHYtCDYotix2qnYpw!5e0!3m2!1sfa!2sus!4v1625319036294!5m2!1sfa!2sus"
                                    >
                            </iframe>
                        </div> -->
                    </div>
                </div>

                <div class="col-12 detile-more-advertising">
                    <span class="detile-more-advertising-subject">آگهی های مشابه</span>
                    <div class="row detile-more-advertising-box">
                        @foreach($data['similar'] as $similar)
                            <div class="col-12 col-lg-4">
                                <a href="{{route('detail',$similar->id)}}">
                                    <div class="detile-more-advertising-box-item">
                                        <img src="{{asset($similar->image)}}" alt="">
                                        <span
                                            class="detile-more-advertising-box-item-title">{{$similar->address}}</span>
                                        <div class="detile-more-advertising-box-item-bottom">
                                            <span>{{$similar->created_at->diffForHumans()}}</span>
                                            <span>{{$similar->number_of_room}} اتاق </span>
                                            <span>{{$similar->area}} متر </span>
                                            <span>{{$similar->estateType[0]->text}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('js/js.js')}}"></script>
@endsection
