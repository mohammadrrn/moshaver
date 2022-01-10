@extends('index')

@section('title','ثبت آگهی')

@section('content')
    <main class="container-fluid">
        <div class="cover-back-send-product"> </div>
        <div class="container main-box-top">
            <form class="row send-product" method="post" action="{{route('request.estate')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="col-12 titr test">
                    <span>ثبت آگهی</span>
                    <br>
                    @if($errors->all())
                        <br>
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                {{$error}} <br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-12 view-order">
                    <span>
                        انتخاب عکس اصلی آگهی
                    </span>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png">
                </div>
                <div class="col-12 col-md-12 view-order">
                    <span>
                        انتخاب عکس های اسلایدر
                    </span>
                    <input type="file" name="slider[]" multiple accept=".jpg,.jpeg,.png">
                </div>
                <div class="col-12 col-md-6 view-order">
                    <span>
                        نوع واگذاری
                    </span>
                    <input type="hidden" class="transfer_id"
                           value="{{old('transfer_id')}}">
                    <select name="transfer_id" class="view-order-select ddlViewBy" id="transfer"
                            aria-label="Default select example">
                        <option disabled selected>انتخاب نوع واگذاری</option>
                        @foreach($data['transfer'] as $transfer)
                            @if(old('transfer_id') == $transfer->id)
                                <option selected value="{{$transfer->id}}">{{$transfer->text}}</option>
                            @else
                                <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <span>
                        نوع ملک
                    </span>
                    <input type="hidden" class="selected_estate" value="{{old('estate_id')}}">
                    <select name="estate_id" class="view-order-select" id="estate" aria-label="Default select example">
                        <option disabled selected>انتخاب نوع ملک</option>
                        @foreach($data['estate'] as $estate)
                            @if(old('estate_id') == $estate->id)
                                <option selected value="{{$estate->id}}">{{$estate->text}}</option>
                            @else
                                <option value="{{$estate->id}}">{{$estate->text}}</option>
                            @endif
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
                    @isset(auth()->user()->area_id)
                        @foreach($data['area'] as $area)
                            @if(auth()->user()->area_id == $area->id)
                                {{$area->text}}
                            @endif
                        @endforeach
                        <input type="hidden" value="{{auth()->user()->area_id}}" name="area_id">
                    @else
                        <span>
                        منطقه
                    </span>
                        <select name="area_id" class="view-order-select" aria-label="Default select example">
                            <option selected disabled>انتخاب منطقه</option>
                            @foreach($data['area'] as $area)
                                @if(old('area_id') == $area->id)
                                    <option selected value="{{$area->id}}">{{$area->text}}</option>
                                @else
                                    <option value="{{$area->id}}">{{$area->text}}</option>
                                @endif
                            @endforeach
                        </select>
                    @endisset
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
                        <input type="text" name="owner_mobile_number" maxlength="11"
                               value="{{old('owner_mobile_number')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره تماس</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="address" value="{{old('address')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>آدرس</label>
                    </div>
                </div>
            <!--                <div class="col-12 col-md-6 view-order">
                    <div class="group">
                        <input type="text" name="street_name" value="{{old('street_name')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام کوچه و خیابان</label>
                    </div>
                </div>-->
                <div class="col-12 col-md-6 view-order" id="plaque">
                    <div class="group">
                        <input type="text" name="plaque" value="{{old('plaque')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>پلاک</label>
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
                <div class="col-12 col-md-3 view-order" id="floor">
                    <div class="group">
                        <input type="text" name="floor" value="{{old('floor')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>طبقه</label>
                    </div>
                </div>
                <div class="col-12 col-md-3 view-order" id="all_floor">
                    <div class="send-request-user-group-option-box group-option-box">
                        <input value="1" type="checkbox" name="all_floor">
                        <label for="all_floor">
                            کل طبقات
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order" id="number_of_floor">
                    <div class="group">
                        <input type="text" name="number_of_floor" maxlength="2" value="{{old('number_of_floor')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تعداد طبقه</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order" id="apartment_unit">
                    <div class="group">
                        <input type="text" name="apartment_unit" value="{{old('apartment_unit')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تعداد واحد</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order" id="number_of_room">
                    <div class="group">
                        <input type="text" name="number_of_room" value="{{old('number_of_room')}}">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تعداد اتاق</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 view-order" id="year_of_construction">
                    <div class="group">
                        <input type="text" name="year_of_construction" value="{{old('year_of_construction')}}"
                               placeholder="1400">
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
                        <option disabled selected>انتخاب جهت ملک</option>
                        @foreach($data['direction'] as $direction)
                            @if(old('direction_id') == $direction->id)
                                <option selected value="{{$direction->id}}">{{$direction->text}}</option>
                            @else
                                <option value="{{$direction->id}}">{{$direction->text}}</option>
                            @endif
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
                @role('admin|user|writer')
                <div class="col-12">
                    <div class="row send-request-user-group-option">
                        <div class="col-12">
                            <span>
                                امکانات ملک
                            </span>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="floor_covering_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب نوع کف پوش</option>
                                    @foreach($data['floorCovering'] as $floorCovering)
                                        @if(old('floor_covering_id') == $floorCovering->id)
                                            <option selected
                                                    value="{{$floorCovering->id}}">{{$floorCovering->text}}</option>
                                        @else
                                            <option value="{{$floorCovering->id}}">{{$floorCovering->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="cabinets_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب نوع کابینت</option>
                                    @foreach($data['cabinets'] as $cabinets)
                                        @if(old('cabinets_id') == $cabinets->id)
                                            <option selected value="{{$cabinets->id}}">{{$cabinets->text}}</option>
                                        @else
                                            <option value="{{$cabinets->id}}">{{$cabinets->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="wall_plugs_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب نوع دیوارپوش</option>
                                    @foreach($data['wallPlugs'] as $wallPlugs)
                                        @if(old('wall_plugs_id') == $wallPlugs->id)
                                            <option selected value="{{$wallPlugs->id}}">{{$wallPlugs->text}}</option>
                                        @else
                                            <option value="{{$wallPlugs->id}}">{{$wallPlugs->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="building_facades_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب نوع نما</option>
                                    @foreach($data['buildingFacades'] as $buildingFacades)
                                        @if(old('building_facades_id') == $buildingFacades->id)
                                            <option selected
                                                    value="{{$buildingFacades->id}}">{{$buildingFacades->text}}</option>
                                        @else
                                            <option value="{{$buildingFacades->id}}">{{$buildingFacades->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="heating_system_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب سیستم گرمایش</option>
                                    @foreach($data['heatingSystem'] as $heatingSystem)
                                        @if(old('heating_system_id') == $heatingSystem->id)
                                            <option selected
                                                    value="{{$heatingSystem->id}}">{{$heatingSystem->text}}</option>
                                        @else
                                            <option value="{{$heatingSystem->id}}">{{$heatingSystem->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="cooling_system_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب سیستم سرمایش</option>
                                    @foreach($data['coolingSystem'] as $coolingSystem)
                                        @if(old('cooling_system_id') == $coolingSystem->id)
                                            <option selected
                                                    value="{{$coolingSystem->id}}">{{$coolingSystem->text}}</option>
                                        @else
                                            <option value="{{$coolingSystem->id}}">{{$coolingSystem->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="document_type_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب نوع سند</option>
                                    @foreach($data['documentType'] as $documentType)
                                        @if(old('document_type_id') == $documentType->id)
                                            <option selected
                                                    value="{{$documentType->id}}">{{$documentType->text}}</option>
                                        @else
                                            <option value="{{$documentType->id}}">{{$documentType->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 view-order">
                            <div class="group">
                                <select name="density_id" class="view-order-select ddlViewBy"
                                        aria-label="Default select example">
                                    <option disabled selected>انتخاب تراکم</option>
                                    @foreach($data['density'] as $density)
                                        @if(old('density_id') == $density->id)
                                            <option selected
                                                    value="{{$density->id}}">{{$density->text}}</option>
                                        @else
                                            <option value="{{$density->id}}">{{$density->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @foreach(\App\Http\Controllers\AssistantController::estateRequestOptions() as $item =>$value)
                            <div class="col-12 col-md-3 ">
                                <div class="send-request-user-group-option-box group-option-box">
                                    @if(old($item) == 1)
                                        <input value="1" type="checkbox" id="option_{{$item}}" name="{{$item}}" checked>
                                        <label for="option_{{$item}}">
                                            {{$value}}
                                        </label>
                                    @else
                                        <input value="1" type="checkbox" id="option_{{$item}}" name="{{$item}}">
                                        <label for="option_{{$item}}">
                                            {{$value}}
                                        </label>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endrole
                {!! NoCaptcha::display() !!}
                <button class="btn insert-btn m-3" type="submit">ثبت آگهی</button>
            </form>
        </div>

    </main>
@endsection

@section('js')
    {!! NoCaptcha::renderJs() !!}
@endsection
