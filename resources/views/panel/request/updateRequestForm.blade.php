@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">

        <div class="row bottom-box-1 list-moshaver">
            <div class="col-12">
            <span class="title-services">
                ویرایش درخواست
            </span>
            </div>

            <div class="send-request">
                <div class="row">
                    <form class="send-request" method="post"
                          action="{{route('panel.request.updateRequest',$data['request']->id)}}">
                        @method('patch')
                        @csrf
                        <div class="col-md-12">
                            <div class="form row">
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="full_name"
                                               value="{{$data['request']->full_name}}"/>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>نام و نام خانوادگی</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="mobile_number"
                                               value="{{$data['request']->mobile_number}}"/>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>شماره همراه</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-select form-select" aria-label="Default select example"
                                            name="area_id">
                                        <option selected disabled>انتخاب منطقه</option>
                                        @foreach($data['area'] as $area)
                                            @if($area->id == $data['request']->area_id)
                                                <option selected value="{{$area->id}}">{{$area->text}}</option>
                                            @else
                                                <option value="{{$area->id}}">{{$area->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="hidden" class="transfer_id"
                                           value="{{$data['request']->transfer_id}}">
                                    <select class="form-select form-select ddlViewBy" name="transfer_id"
                                            aria-label="Default select example" id="transfer">
                                        <option disabled selected>انتخاب نوع واگذاری</option>
                                        @foreach($data['transfer'] as $transfer)
                                            @if($transfer->id == $data['request']->transfer_id)
                                                <option selected value="{{$transfer->id}}">{{$transfer->text}}</option>
                                            @else
                                                <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="range_of_address"
                                               value="{{$data['request']->range_of_address}}"/>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>حدود متراژ درخواستی</label>
                                    </div>
                                </div>
                                <div id="buy_price" class="col-12 view-order number-separator price">
                                    <div class="group">
                                        <input type="text" name="buy_price"
                                               value="{{number_format($data['request']->buy_price)}}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>مبلغ خرید (تومان)</label>
                                    </div>
                                </div>
                                <div id="mortgage_price" class="col-12 col-md-6 view-order number-separator price">
                                    <div class="group">
                                        <input type="text" name="mortgage_price"
                                               value="{{number_format($data['request']->mortgage_price)}}"
                                        >
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>مبلغ رهن (تومان)</label>
                                    </div>
                                </div>
                                <div id="rent_price" class="col-12 col-md-6 view-order number-separator price">
                                    <div class="group">
                                        <input type="text" name="rent_price"
                                               value="{{number_format($data['request']->rent_price)}}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>مبلغ اجاره (تومان)</label>
                                    </div>
                                </div>
                                <div id="participation_price" class="col-12 col-md-6 view-order number-separator price">
                                    <div class="group">
                                        <input type="text" name="participation_price"
                                               value="{{number_format($data['request']->participation_price)}}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>مبلغ مشارکت (تومان)</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="description"
                                               value="{{$data['request']->description}}"/>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>توضیحات</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 send-request-end">
                                    <div class="send-request-left-bottom">
                                        <!-- <img src="../icon/PanelAdmin/icons8_image_100px.png" alt=""> -->
                                        <!-- <img src="../icon/PanelAdmin/icons8_link_100px.png" alt=""> -->
                                        <button type="submit" class="btn moshaver-insert">ویرایش درخواست</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
