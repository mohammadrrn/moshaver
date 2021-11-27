@extends('index')

@section('title','جزئیات آگهی')

@section('content')
    <main class="container-fluid">
        <a href="#" class=" back-detile">
            <img src="{{asset('icon/icons8_forward_32px_1.png')}}">
            <span>بازگشت</span>
        </a>

        <div class="detile-box-slider">
            <div class="row">
                <div class="col-12 col-lg-6 ">
                    <div class="detile-box-slider-right">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{asset('img/detile-slider.png')}}"
                                         alt="First slide">
                                    <img class="carousel-item-title" src="{{asset('icon/detile-back-img-item.png')}}">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{asset('img/img-slider.png')}}" alt="Second slide">
                                    <img class="carousel-item-title" src="{{asset('icon/detile-back-img-item.png')}}">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{asset('img/detile-slider.png')}}"
                                         alt="Third slide">
                                    <img class="carousel-item-title" src="{{asset('icon/detile-back-img-item.png')}}">
                                </div>
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
                            @if($data['detail']->rent_price != 0 || $data['detail']->mortgage_price != 0)
                                <div class="detile-specifications-top-2-right">
                                    <p>رهن : {{number_format($data['detail']->mortgage_price)}} هزار تومان </p>
                                    <p>اجاره : {{number_format($data['detail']->rent_price)}} هزار تومان </p>
                                </div>
                            @else
                            @endif
                            <div class="detile-specifications-top-2-left">
                                <img src="{{asset('icon/error.svg')}}">
                                <img src="{{asset('icon/bookmark.svg')}}">
                                <img src="{{asset('icon/share.svg')}}">
                            </div>
                        </div>
                        <div class="detile-specifications-top-3">
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/apartment_icon.svg')}}">
                                <span>{{$data['detail']->estateType[0]->text}}</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/phone.svg')}}">
                                <span>{{$data['detail']->owner_mobile_number}}</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/planner.svg')}}">
                                <span>{{$data['detail']->year_of_construction}} سال </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/address.svg')}}">
                                <span>{{$data['detail']->address.' - '. $data['detail']->street_name}}</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/sleeping_in_bed.svg')}}">
                                <span>{{$data['detail']->number_of_room}} اتاق </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/eye.svg')}}">
                                <span>بازدید3</span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/icons8_surface_1.svg')}}">
                                <span>{{$data['detail']->area}} متر </span>
                            </div>
                            <div class="detile-specifications-top-3-item">
                                <img src="{{asset('icon/male_user.svg')}}">
                                <span>{{$data['detail']->owner_name}}</span>
                            </div>
                        </div>

                        <div class="detile-specifications-top-4">
                            <div class="row">
                                @foreach(\App\Http\Controllers\AssistantController::estateRequestOptions() as $item=>$value)
                                    @if($data['detail']->$item == 1)
                                        <svpan class="col-12 col-md-6">{{$value}}</svpan>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                        @role('admin')
                        <div class="detile-specifications-top-5">
                            <a class="detile-specifications-top-5-button"
                               href="{{route('estateRequest.updateEstateRequestForm',$data['detail']->id)}}">ویرایش</a>
                            <button class="detile-specifications-top-5-button">افزودن به زونکن</button>
                            <button class="detile-specifications-top-5-button">گزارش واگذاری این ملک</button>
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
                        <div class="col-12 col-lg-4">
                            <div class="detile-more-advertising-box-item">
                                <img src="{{asset('img/img-slider.png')}}" alt="">
                                <img class="detile-more-advertising-box-item-back"
                                     src="{{asset('icon/detile-back-img-item.png')}}">
                                <span class="detile-more-advertising-box-item-title">فروش ویلایی سید رضی</span>
                                <div class="detile-more-advertising-box-item-bottom">
                                    <span>4 روز پیش</span>
                                    <span>4خواب</span>
                                    <span>410 متر</span>
                                    <span>مسکونی</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="detile-more-advertising-box-item">
                                <img src="{{asset('img/img-slider.png')}}" alt="">
                                <img class="detile-more-advertising-box-item-back"
                                     src="{{asset('icon/detile-back-img-item.png')}}">
                                <span class="detile-more-advertising-box-item-title">فروش ویلایی سید رضی</span>
                                <div class="detile-more-advertising-box-item-bottom">
                                    <span>4 روز پیش</span>
                                    <span>4خواب</span>
                                    <span>410 متر</span>
                                    <span>مسکونی</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="detile-more-advertising-box-item">
                                <img src="{{asset('img/img-slider.png')}}" alt="">
                                <img class="detile-more-advertising-box-item-back"
                                     src="{{asset('icon/detile-back-img-item.png')}}">
                                <span class="detile-more-advertising-box-item-title">فروش ویلایی سید رضی</span>
                                <div class="detile-more-advertising-box-item-bottom">
                                    <span>4 روز پیش</span>
                                    <span>4خواب</span>
                                    <span>410 متر</span>
                                    <span>مسکونی</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('js/js.js')}}"></script>
@endsection
