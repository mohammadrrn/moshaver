@extends('index')

@section('title','جستجو ')

@section('content')
    <main class="container-fluid">
        <div class="main-box-center">
            <div class="row  main-box-center-row">
                <div class="col-3">
                     
                </div>
                <div class="col-12 col-md-3 list-icon">
                <!--                    <img class="list-svg" src="{{asset('icon/list.svg')}}" alt="">-->
                    <img class="categorize-svg" src="{{asset('icon/categorize.svg')}}" alt="">
                    <!--                    <select class="filter-form-control form-control form-control-list-icon">
                                            <option selected disabled>ترتیب  </option>
                                            <option>قیمت</option>
                                            <option>قیمت</option>

                                        </select>-->
                </div>
                <div class="col-3">
                     
                </div>
                <div class="col-3">
                     
                </div>
                <div class="col-12 col-md-3 filter-form">
                    <form action="{{route('searchResult')}}" method="post">
                    @csrf
                    <!--                    <select class="filter-form-control form-control">
                                            <option selected>شهر</option>
                                            <option>خراسان رضوی</option>
                                            <option>رشتخوار</option>
                                            <option>کلات</option>
                                            <option>نیشابور</option>
                                            <option>فیروزه</option>
                                        </select>-->
                        <select class="filter-form-control form-control" name="area_id">
                            <option selected disabled>انتخاب منطقه</option>
                            @foreach($data['area'] as $area)
                                <option value="{{$area->id}}">{{$area->text}}</option>
                            @endforeach
                        </select>
                        <select class="filter-form-control form-control" name="transfer_id">
                            <option selected disabled>انتخاب نوع واگذاری</option>
                            @foreach($data['transfer'] as $transfer)
                                <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                            @endforeach
                        </select>
                        <select class="filter-form-control form-control" name="estate_id">
                            <option selected disabled>انتخاب نوع ملک</option>
                            @foreach($data['estateType'] as $estate)
                                <option value="{{$estate->id}}">{{$estate->text}}</option>
                            @endforeach
                        </select>
                        <select class="filter-form-control form-control" name="direction_id">
                            <option selected disabled>انتخاب جهت ساختمان</option>
                            @foreach($data['direction'] as $direction)
                                <option value="{{$direction->id}}">{{$direction->text}}</option>
                            @endforeach
                        </select>

                        <select class="filter-form-control form-control" name="year_of_construction">
                            <option selected disabled>انتخاب سال ساخت</option>
                            @for($i=1400;$i>1390;$i--)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                            <option value="old">قبل از 1391</option>
                        </select>
                        <select class="filter-form-control form-control" name="floor">
                            <option selected disabled>طبقه</option>
                            @for($i=1;$i<10;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                            <option value="more_floor">بیش تر از 9</option>
                        </select>

                        <input class="form-control" type="text" name="id" placeholder="کد ملک">

                        <div class="filter-form-box-option">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <div class="btn collapsed" data-toggle="collapse"
                                                 data-target="#collapseThree" aria-expanded="false"
                                                 aria-controls="collapseThree">
                                                امکانات
                                            </div>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                         data-parent="#accordion">
                                        @foreach($data['options'] as $option=>$value)
                                            <div class="box-chekbox box-chekbox-firest">
                                                {{$value}}
                                                <input type="checkbox" name="{{"option[$option]"}}" value="1">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-insert btn-block">جستجو</button>
                    </form>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row page-filter">
                        @if($data['type'] == 'marked')
                            @foreach($data['estateRequests'] as $request)
                                <div class="col-12 col-sm-6 col-md-4 main-box-center-item">
                                    <div class="box-sell">
                                        <span class="id-home">کد ملک : {{$request->estate[0]->id}}</span>
                                        <div class="box-sell-top">
                                            <a href="{{route('detail',$request->estate[0]->id)}}">
                                                <img class="box-sell-top-img" src="{{asset('img/img-slider.png')}}">
                                            </a>
                                            <span class="box-sell-top-title">
                                        {{$request->estate[0]->address}}
                                    </span>
                                            <div class="box-sell-top-mark">
                                                <img class="marked" id="mark_{{$request->estate[0]->id}}"
                                                     aria-valuetext="{{$request->estate[0]->id}}"
                                                     src="{{asset('icon/marked.png')}}">
                                            </div>
                                        </div>
                                        <div class="box-sell-bottom-bottom">
                                            <div class="box-sell-bottom-bottom-right">
                                                @if($request->estate[0]->rent_price != 0 || $request->estate[0]->mortgage_price != 0)
                                                    <div class="box-sell-bottom-bottom-right-item">
                                                        <span>اجاره:</span>
                                                        <span>{{number_format($request->estate[0]->rent_price)}} هزار تومان </span>
                                                    </div>
                                                    <div class="box-sell-bottom-bottom-right-item">
                                                        <span>رهن:</span>
                                                        <span>{{number_format($request->estate[0]->mortgage_price)}} هزار تومان </span>
                                                    </div>
                                                @else
                                                    <div class="box-sell-bottom-bottom-right-item">
                                                        <span>خرید:</span>
                                                        <span>{{number_format($request->estate[0]->buy_price)}} هزار تومان </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="box-sell-bottom-bottom-left time">
                                            <span>{{$request->estate[0]->owner_name}}</span>
                                            <span>{{$request->estate[0]->created_at->diffForHumans()}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($data['estateRequests'] as $request)
                                <div class="col-12 col-sm-6 col-md-4 main-box-center-item">
                                    <div class="box-sell">
                                        <span class="id-home">کد ملک : {{$request->id}}</span>
                                        <div class="box-sell-top">
                                            <a href="{{route('detail',$request->id)}}">
                                                <img class="box-sell-top-img" src="{{asset('img/img-slider.png')}}">
                                            </a>
                                            <span class="box-sell-top-title">
                                        {{$request->address}}
                                    </span>
                                            <div class="box-sell-top-mark">

                                                @isset($request->book[0])
                                                    <img class="marked" id="mark_{{$request->id}}"
                                                         aria-valuetext="{{$request->id}}"
                                                         src="{{asset('icon/marked.png')}}">
                                                @else
                                                    <img class="marked" id="mark_{{$request->id}}"
                                                         aria-valuetext="{{$request->id}}"
                                                         src="{{asset('icon/mark-icon.png')}}">
                                                @endisset
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
                                        <div class="box-sell-bottom-bottom-left time">
                                            <span>{{$request->owner_name}}</span>
                                            <span>{{$request->created_at->diffForHumans()}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                {{$data['estateRequests']->links()}}
                <!--                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" tabindex="-1">قبل</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">بعد</a>
                            </li>
                        </ul>
                    </nav>-->
                </div>
            </div>
        </div>
    </main>
@endsection
