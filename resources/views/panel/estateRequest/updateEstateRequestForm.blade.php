@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver">
            <div class="col-12">
            <span class="title-services">
                ویرایش درخواست ثبت ملک
            </span>
                @role('writer|admin')
                @if($data['estateRequest']->status == 1)
                    <form class="mt-3"
                          action="{{route('panel.cession.confirmCessionManual',$data['estateRequest']->id)}}"
                          method="post">
                        @csrf
                        <input type="hidden" name="estate_request_id" value="{{$data['estateRequest']->id}}">
                        <input class="btn btn-sm btn-success" type="submit" value="اعلام واگذاری">
                    </form>
                    <form class="mt-3" action="{{route('panel.estateRequest.unConfirmEstateRequest')}}" method="post">
                        @csrf
                        <input type="hidden" name="estate_request_id" value="{{$data['estateRequest']->id}}">
                        <input class="btn btn-sm btn-danger" type="submit" value="عدم نمایش">
                        <a class="btn btn-sm btn-danger btn-sm"
                           href="{{route('panel.estateRequest.deleteEstateRequestForm',$data['estateRequest']->id)}}">حذف</a>
                    </form>
                @elseif($data['estateRequest']->status == 0)
                    <form class="mt-3" action="{{route('panel.estateRequest.confirmEstateRequest')}}"
                          method="post">
                        @csrf
                        <input type="hidden" name="estate_request_id"
                               value="{{$data['estateRequest']->id}}">
                        <input class="btn btn-sm btn-success btn-sm" type="submit" value="تایید">
                        <a class="btn btn-sm btn-danger btn-sm"
                           href="{{route('panel.estateRequest.deleteEstateRequestForm',$data['estateRequest']->id)}}">حذف</a>
                    </form>
                @elseif($data['estateRequest']->status == 2)
                    <form class="mt-3" action="{{route('panel.cession.unconfirmedCession',$data['estateRequest']->id)}}"
                          method="post">
                        @csrf
                        <input type="hidden" name="estate_request_id" value="{{$data['estateRequest']->id}}">
                        <input class="btn btn-sm btn-danger" type="submit" value="اشتباه واگذار شده">
                        <a class="btn btn-sm btn-danger btn-sm"
                           href="{{route('panel.estateRequest.deleteEstateRequestForm',$data['estateRequest']->id)}}">حذف</a>
                    </form>
                    <form class="mt-3" action="{{route('panel.estateRequest.unConfirmEstateRequest')}}" method="post">
                        @csrf
                        <input type="hidden" name="estate_request_id" value="{{$data['estateRequest']->id}}">
                        <input class="btn btn-sm btn-danger" type="submit" value="عدم نمایش">
                    </form>
                @endif
                @if($data['estateRequest']->user_id != null)
                    <div class="mt-3">
                        <form action="{{route('panel.estateRequest.rejectConfirmation')}}" method="post">
                            @csrf
                            <input type="hidden" name="estate_request_id" value="{{$data['estateRequest']->id}}">
                            <textarea name="reason"
                                      style="width: 100%;border: 1px solid #ccc;padding: 5px;border-radius: 5px;"
                                      placeholder="دلیل رد تایید آگهی"></textarea>
                            <input class="btn btn-danger btn-sm" type="submit" value="رد تایید">
                        </form>
                    </div>
                @endif
                @endrole
            </div>
            <form class="send-request" method="post" enctype="multipart/form-data"
                  action="{{route('panel.estateRequest.updateEstateRequest',$data['estateRequest']->id)}}">
                @method('patch')
                @csrf
                @if($data['estateRequest']->reason != '')
                    <h5 class="text-danger">دلایل رد تایید آگهی</h5>
                    <span class="alert-danger">{{$data['estateRequest']->reason}}</span>
                    <hr>
                @endif
                <input type="hidden" name="deleted_slider" id="deleted_slider">
                <input type="hidden" name="deleted_image" id="deleted_image">
                <div class=" row send-product">
                    <div class="col-12 col-md-8">
                        <div style="position:relative;display: inline-block" id="image">
                            <span class="delete-image"
                                  style="position: absolute;top: 15px;padding: 5px 10px;left: 5px;background: rgba(0,0,0,0.5);border-radius: 5px;color: white;cursor: pointer">🗙</span>
                            <a href="{{asset($data['estateRequest']->image)}}" target="_blank">
                                <img
                                    style="width: 400px;height: 200px;border-radius: 10px;box-shadow: 0 5px 10px #dbdbdb;margin: 10px 0"
                                    src="{{asset($data['estateRequest']->image)}}">
                            </a>
                        </div>
                        @if($data['estateRequest']->sliders)
                            @foreach(json_decode($data['estateRequest']->sliders) as $key=>$slider)
                                <div style="position:relative;display: inline-block" id="slider_{{$key}}">
                                    <span class="delete-slider" aria-valuetext="{{$key}}"
                                          style="position: absolute;top: 15px;padding: 5px 10px;left: 5px;background: rgba(0,0,0,0.5);border-radius: 5px;color: white;cursor: pointer">🗙</span>
                                    <a href="{{asset($slider)}}" target="_blank">
                                        <img
                                            style="width: 200px;height: 200px;border-radius: 10px;box-shadow: 0 5px 10px #dbdbdb;margin: 10px 0"
                                            src="{{asset($slider)}}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="row form">
                            <div class="col-12">
                                <div class="group">
                                    <input type="file" name="image" accept=".jpg,.jpeg,.png">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>
                                        تغییر عکس اصلی آگهی
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <input type="file" name="slider[]" multiple accept=".jpg,.jpeg,.png">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>
                                        تغییر عکس های اسلایدر
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 ">
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
                                <input type="hidden" class="transfer_id"
                                       value="{{$data['estateRequest']->transfer_id}}">
                                <div class="group">
                                    <select class="form-select form-select ddlViewBy" name="transfer_id"
                                            id="transfer"
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
                                <input type="hidden" class="selected_estate"
                                       value="{{$data['estateRequest']->estate_id}}">
                                <div class="group">
                                    <select class="form-select form-select ddlViewBy" name="estate_id"
                                            aria-label="Default select example" id="estate">
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
                                    <select class="form-select form-select" name="area_id">
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
                        <!--                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="street_name"
                                           value="{{$data['estateRequest']->street_name}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>نام کوچه</label>
                                </div>
                            </div>-->
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
                            <div id="buy_price" class="col-12 view-order number-separator price">
                                <div class="group">
                                    <input type="text" name="buy_price"
                                           value="{{number_format($data['estateRequest']->buy_price)}}">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>مبلغ خرید (تومان)</label>
                                </div>
                            </div>
                            <div id="mortgage_price" class="col-12 col-md-6 view-order number-separator price">
                                <div class="group">
                                    <input type="text" name="mortgage_price"
                                           value="{{number_format($data['estateRequest']->mortgage_price)}}"
                                    >
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>مبلغ رهن (تومان)</label>
                                </div>
                            </div>
                            <div id="rent_price" class="col-12 col-md-6 view-order number-separator price">
                                <div class="group">
                                    <input type="text" name="rent_price"
                                           value="{{number_format($data['estateRequest']->rent_price)}}">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>مبلغ اجاره (تومان)</label>
                                </div>
                            </div>
                            <div id="participation_price" class="col-12 col-md-6 view-order number-separator price">
                                <div class="group">
                                    <input type="text" name="participation_price"
                                           value="{{number_format($data['estateRequest']->participation_price)}}">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>مبلغ مشارکت (تومان)</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3" id="floor">
                                <div class="group">
                                    @if($data['estateRequest']->floor == 100)
                                        <input type="text" name="floor" value="100" id="floor_disable"
                                               style="display: none"
                                               placeholder="طبقه"/>
                                    @else
                                        <input type="text" name="floor" value="{{$data['estateRequest']->floor}}"
                                               id="floor_disable" placeholder="طبقه"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12  col-md-3" id="all_floor">
                                <div class="send-request-group-option-box group-option-box">
                                    @if($data['estateRequest']->floor == 100)
                                        <input value="1" type="checkbox" name="all_floor" checked id="all_floor_status">
                                    @else
                                        <input value="1" type="checkbox" name="all_floor" id="all_floor_status">
                                    @endif
                                    <label for="all_floor">
                                        کل طبقات
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" id="number_of_floor">
                                <div class="group">
                                    <input type="text" name="number_of_floor"
                                           value="{{$data['estateRequest']->number_of_floor}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>تعداد طبقه</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" id="apartment_unit">
                                <div class="group">
                                    <input type="text" name="apartment_unit"
                                           value="{{$data['estateRequest']->apartment_unit}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>تعداد واحد</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" id="number_of_room">
                                <div class="group">
                                    <input type="text" name="number_of_room"
                                           value="{{$data['estateRequest']->number_of_room}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>تعداد اتاق</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" id="year_of_construction">
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
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="description"
                                           value="{{$data['estateRequest']->description}}"/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>توضیحات</label>
                                </div>
                            </div>
                        </div>
                        <div class="form row send-request-group-option">
                            <div class="col-12">
                                <h5>
                                    امکانات ملک
                                </h5>
                            </div>
                            <div class="col-12 col-md-6 view-order">
                                <div class="group">
                                    <select name="floor_covering_id"
                                            class="form-select form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب نوع کف پوش</option>
                                        @foreach($data['floorCovering'] as $floorCovering)
                                            @if($floorCovering->id == $data['estateRequest']->floor_covering_id)
                                                <option selected
                                                        value="{{$floorCovering->id}}">{{$floorCovering->text}}</option>
                                            @else
                                                <option
                                                    value="{{$floorCovering->id}}">{{$floorCovering->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 view-order">
                                <div class="group">
                                    <select name="cabinets_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب نوع کابینت</option>
                                        @foreach($data['cabinets'] as $cabinets)
                                            @if($cabinets->id == $data['estateRequest']->cabinets_id)
                                                <option selected
                                                        value="{{$cabinets->id}}">{{$cabinets->text}}</option>
                                            @else
                                                <option
                                                    value="{{$cabinets->id}}">{{$cabinets->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 view-order">
                                <div class="group">
                                    <select name="wall_plugs_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب نوع دیوارپوش</option>
                                        @foreach($data['wallPlugs'] as $wallPlugs)
                                            @if($wallPlugs->id == $data['estateRequest']->wall_plugs_id)
                                                <option selected
                                                        value="{{$wallPlugs->id}}">{{$wallPlugs->text}}</option>
                                            @else
                                                <option
                                                    value="{{$wallPlugs->id}}">{{$wallPlugs->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 view-order">
                                <div class="group">
                                    <select name="building_facades_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب نوع نما</option>
                                        @foreach($data['buildingFacades'] as $buildingFacades)
                                            @if($buildingFacades->id == $data['estateRequest']->building_facades_id)
                                                <option selected
                                                        value="{{$buildingFacades->id}}">{{$buildingFacades->text}}</option>
                                            @else
                                                <option
                                                    value="{{$buildingFacades->id}}">{{$buildingFacades->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 view-order">
                                <div class="group">
                                    <select name="heating_system_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب سیستم گرمایش</option>
                                        @foreach($data['heatingSystem'] as $heatingSystem)
                                            @if($heatingSystem->id == $data['estateRequest']->heating_system_id)
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
                                    <select name="cooling_system_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب سیستم سرمایش</option>
                                        @foreach($data['coolingSystem'] as $coolingSystem)
                                            @if($coolingSystem->id == $data['estateRequest']->cooling_system_id)
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
                                    <select name="document_type_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب نوع سند</option>
                                        @foreach($data['documentType'] as $documentType)
                                            @if($documentType->id == $data['estateRequest']->document_type_id)
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
                                    <select name="density_id" class="form-select view-order-select ddlViewBy"
                                            aria-label="Default select example">
                                        <option disabled selected>انتخاب تراکم</option>
                                        @foreach($data['density'] as $density)
                                            @if($density->id == $data['estateRequest']->density_id)
                                                <option selected
                                                        value="{{$density->id}}">{{$density->text}}</option>
                                            @else
                                                <option value="{{$density->id}}">{{$density->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row send-request-group-option">
                            @foreach(\App\Http\Controllers\AssistantController::estateRequestOptions() as $item =>$value)
                                <div class="col-12  col-md-3 ">
                                    <div class="send-request-group-option-box group-option-box">
                                        <input type="checkbox" name="options[{{$item}}]" id="option_{{$item}}"
                                               value="1" {{ $data['estateRequest']->$item === 1 ? 'checked' : false }}>
                                        <label for="option_{{$item}}">
                                            {{$value}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 send-request-end">
                                <div class="send-request-left-bottom m-3">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{route('panel.estateRequest.unconfirmedEstateRequestList')}}">بازگشت</a>
                                    <button type="submit" class="btn m-3 moshaver-insert">ویرایش ملک</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('js')
    <script>
        const deleted_slider = [];
        $('.delete-slider').click(function () {
            const slider_id = $(this).attr('aria-valuetext');
            deleted_slider.push(slider_id);
            $('#slider_' + slider_id).fadeOut();
            $('#deleted_slider').val(deleted_slider);
        });
        $('.delete-image').click(function () {
            $('#image').fadeOut();
            $('#deleted_image').val(1);
        });
    </script>
@endsection
