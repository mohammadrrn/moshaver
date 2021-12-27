@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver">
            <div class="col-12">
            <span class="title-services">
                ویرایش درخواست ثبت ملک
            </span>
            </div>

            <form class="send-request" method="post"
                  action="{{route('panel.estateRequest.updateEstateRequest',$data['estateRequest']->id)}}">
                @method('patch')
                @csrf
                <div class="row">
                    <div class="col-12 col-md-8">
                    </div>
                    <div class="col-md-12">
                        <div class="form row">
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="owner_name"
                                           value="{{$data['estateRequest']->owner_name}}">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>نام مالک</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="owner_mobile_number"
                                           value="{{$data['estateRequest']->owner_mobile_number}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>شماره همراه</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <select class="form-select form-select ddlViewBy" name="transfer_id"
                                            aria-label="Default select example">
                                        <option disabled>انتخاب نوع واگذاری</option>
                                        @foreach($data['transfer'] as $transfer)
                                            @if($transfer->id == $data['estateRequest']->transfer_id)
                                                <option selected value="{{$transfer->id}}">{{$transfer->text}}</option>
                                            @else
                                                <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <select class="form-select form-select ddlViewBy" name="estate_id"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب نوع ملک</option>
                                        @foreach($data['estate'] as $estate)
                                            @if($estate->id == $data['estateRequest']->estate_id)
                                                <option selected value="{{$estate->id}}">{{$estate->text}}</option>
                                            @else
                                                <option value="{{$estate->id}}">{{$estate->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="group">
                                    <select class="form-select form-select" aria-label="Default select example"
                                            name="area_id">
                                        <option selected disabled>انتخاب منطقه</option>
                                        @foreach($data['area'] as $area)
                                            @if($area->id == $data['estateRequest']->area_id)
                                                <option selected value="{{$area->id}}">{{$area->text}}</option>
                                            @else
                                                <option value="{{$area->id}}">{{$area->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <input type="text" name="address" value="{{$data['estateRequest']->address}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>آدرس</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="street_name"
                                           value="{{$data['estateRequest']->street_name}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>نام کوچه</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="plaque" value="{{$data['estateRequest']->plaque}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>پلاک</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="area" value="{{$data['estateRequest']->area}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>متراژ</label>
                                </div>
                            </div>
                            <div id="box-by" class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="buy_price" value="{{$data['estateRequest']->buy_price}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>قیمت خرید</label>
                                </div>
                            </div>
                            <div id="box-mortgage" class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="mortgage_price"
                                           value="{{$data['estateRequest']->mortgage_price}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>قیمت رهن</label>
                                </div>
                            </div>
                            <div id="box-rent" class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="rent_price"
                                           value="{{$data['estateRequest']->rent_price}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>قیمت اجاره</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="floor" value="{{$data['estateRequest']->floor}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>طبقه</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="number_of_floor"
                                           value="{{$data['estateRequest']->number_of_floor}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>تعداد طبقه</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="apartment_unit"
                                           value="{{$data['estateRequest']->apartment_unit}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>تعداد واحد</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="owner_mobile_room"
                                           value="{{$data['estateRequest']->number_of_room}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>تعداد اتاق</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="year_of_construction"
                                           value="{{$data['estateRequest']->year_of_construction}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>سال ساخت</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-select form-select" aria-label="Default select example"
                                        name="direction_id">
                                    <option disabled selected>انتخاب جهت ساختمان</option>
                                    @foreach($data['direction'] as $direction)
                                        @if($direction->id == $data['estateRequest']->direction_id)
                                            <option selected value="{{$direction->id}}">{{$direction->text}}</option>
                                        @else
                                            <option value="{{$direction->id}}">{{$direction->text}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <input type="text" name="description"
                                           value="{{$data['estateRequest']->description}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>توضیحات</label>
                                </div>
                            </div>
                        </div>
                        <div class="row send-request-group-option">
                            <div class="col-12">
                                        <span>
                                            امکانات ملک
                                        </span>
                            </div>
                            @foreach(\App\Http\Controllers\AssistantController::estateRequestOptions() as $item =>$value)
                                <div class="col-12 col-md-3 ">
                                    <div class="send-request-group-option-box group-option-box">
                                        <input type="checkbox" name="{{$item}}" id="option_{{$item}}"
                                               value="1" {{ $data['estateRequest']->$item === 1 ? 'checked' : false }}>
                                        <label for="option_{{$item}}">
                                            {{$value}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 send-request-end">
                                <div class="send-request-left-bottom">
                                    <button type="submit" class="btn moshaver-insert">ویرایش ملک</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
