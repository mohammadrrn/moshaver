@extends('index')

@section('title','مشاور 007')

@section('content')

    <main class="container-fluid">
        <div class="container main-box-top">
            <div class="row main-box-top-row">
                <div class="col-12 col-md-6 main-box-top-right">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('img/detile-slider.png')}}" alt="First slide">
                                <span class="carousel-item-title">خانه جهانی پیدا کن</span>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('img/detile-slider.png')}}" alt="Second slide">
                                <span class="carousel-item-title">خانه جهانی پیدا کن</span>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('img/detile-slider.png')}}" alt="Third slide">
                                <span class="carousel-item-title">خانه جهانی پیدا کن</span>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-12 col-md-6 main-box-top-left">

                    <a href="filter.html" class="main-box-top-left-item main-box-top-left-item-mortgage">
                        <img class="mortgage" src="{{asset('icon/mortgage.svg')}}">
                        <img class="mortgage-1" src="{{asset('icon/mortgage-1.svg')}}">
                        <span>رهن اجاره</span>
                    </a>
                    <a href="filter.html" class="main-box-top-left-item main-box-top-left-item-ordera">
                        <img class="ordera" src="{{asset('icon/create_order.svg')}}">
                        <img class="ordera-1" src="{{asset('icon/create_order-1.svg')}}">
                        <span>خرید و فروش</span>
                    </a>
                    <a href="Trusted-offices.html" class="main-box-top-left-item main-box-top-left-item-chair">
                        <img class="chair" src="{{asset('icon/wing_chair.svg')}}">
                        <img class="chair-1" src="{{asset('icon/wing_chair-1.svg')}}">
                        <span>دفاتر مورد اعتماد</span>
                    </a>
                    <a href="{{route('request.requestForm')}}"
                       class="main-box-top-left-item main-box-top-left-item-invite">
                        <img class="invite" src="{{asset('icon/invite.svg')}}">
                        <img class="invite-1" src="{{asset('icon/invite-1.svg')}}">
                        <span>ثبت درخواست</span>
                    </a>
                    <a href="{{route('request.estateForm')}}"
                       class="main-box-top-left-item main-box-top-left-item-mark">
                        <img class="mark" src="{{asset('icon/mark_as_favorite.svg')}}">
                        <img class="mark-1" src="{{asset('icon/mark_as_favorite-1.svg')}}">
                        <span>ثبت ملک</span>
                    </a>
                    <a href="filter.html" class="main-box-top-left-item main-box-top-left-item-new-file">
                        <img class="new-file" src="{{asset('icon/file_settings.svg')}}">
                        <img class="new-file-1" src="{{asset('icon/file_settings-1.svg')}}">
                        <span>نشان شده ها</span>
                    </a>

                </div>
            </div>
        </div>

        <div class="container main-box-center">
            <div class="row  main-box-center-row">
                @foreach($data['estateRequest'] as $request)

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 main-box-center-item">
                        <div class="box-sell">
                            <div class="box-sell-top">
                                <a href="{{route('detail',$request->id)}}">
                                    <img class="box-sell-top-img" src="{{asset('img/img-slider.png')}}">
                                </a>
                                <span class="box-sell-top-title">
                                {{$request->address}}
                            </span>
                                <div class="box-sell-top-mark">
                                    <img src="{{asset('icon/mark-icon.png')}}">
                                </div>
                            </div>
                            <div class="box-sell-bottom-bottom">
                                <div class="box-sell-bottom-bottom-right">
                                    @if($request->rent_price != 0 || $request->mortgage_price != 0)
                                        <div class="box-sell-bottom-bottom-right-item">
                                            <span>اجاره:</span>
                                            <span>{{number_format($request->rent_price)}} هزار تومان </span>
                                        </div>
                                        <div class="box-sell-bottom-bottom-right-item">
                                            <span>رهن:</span>
                                            <span>{{number_format($request->mortgage_price)}} هزار تومان </span>
                                        </div>
                                    @else
                                        <div class="box-sell-bottom-bottom-right-item">
                                            <span>خرید:</span>
                                            <span>{{number_format($request->buy_price)}} هزار تومان </span>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <!--                    <div class="box-sell-bottom">
                                                    <div class="box-sell-bottom-top">
                                                        <div class="box-sell-bottom-top-item">
                                                            <img src="icon/icons8_surface_1.svg">
                                                            <span>20 متر</span>
                                                        </div>
                                                        <div class="box-sell-bottom-top-item">
                                                            <img src="icon/icons8_sleeping_in_bed_1.svg">
                                                            <span>3 خواب</span>
                                                        </div>
                                                        <div class="box-sell-bottom-top-item">
                                                            <img src="icon/icons8_home_4.svg">
                                                            <span>مسکونی</span>
                                                        </div>
                                                    </div>
                                                </div>-->
                            <div class="box-sell-bottom-bottom-left time">
                                <span>{{$request->owner_name}}</span>
                                <span>{{$request->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                {{$data['estateRequest']->links()}}
                <!-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" tabindex="-1">«قبل</a>

                            </li>
                            <li class="page-item "><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">بعد»</a>
                            </li>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>
    </main>
@endsection
