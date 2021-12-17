@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                        <span class="title-services">
                           لیست درخواست های تایید شده ثبت ملک
                        </span>
            </div>
            <div class="col-12">
                <!--                <div class="row list-moshaver-top">


                                    <div class="col-12 col-md-3">
                                        <div class="list-request-box-group">
                                            <input type="text" placeholder="نام کاربر">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="list-request-box-group">
                                            <input type="text" placeholder="کد ملی کاربر">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 ">
                                        <div class="list-request-box-group">
                                            <select class="form-select form-select" aria-label="Default select example">
                                                <option selected disabled>نوع کاربر</option>
                                                <option value="1">طلایی</option>
                                                <option value="2">نقره ای</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 ">
                                        <div class="list-request-box-group">
                                            <select class="form-select form-select" aria-label="Default select example">
                                                <option selected disabled>وضعیت کاربر</option>
                                                <option value="1">فعال</option>
                                                <option value="2">غیر فعال</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="list-request-box-group-button">
                                            <button class=" btn-block">جستجو</button>
                                        </div>
                                    </div>


                                </div>-->
            </div>
            <div class="col-12 table list-customer-table">
                <table>
                    <tr>
                        <th>کد درخواست</th>
                        <th>نام و نام خانوادگی مالک</th>
                        <th>نقش</th>
                        <th>شماره تماس مالک</th>
                        <th>منطقه</th>
                        <th>نوع واگذاری</th>
                        <th>نوع ملک</th>
                        <th>آدرس</th>
                        <th>متراژ</th>
                        <th>نام کوچه و خیابان</th>
                        <th>پلاک</th>
                        <th>تعداد طبقه</th>
                        <th>تعداد اتاق</th>
                        <th>تعداد واحد</th>
                        <th>سال ساخت</th>
                        <th>جهت ملک</th>
                        <th>مبلغ خرید</th>
                        <th>مبلغ رهن</th>
                        <th>مبلغ اجاره</th>
                        <th>توضیحات</th>
                        <th>وضعیت</th>
                        <th>عدم نمایش</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($data['estateRequestList'] as $request)
                        <tr>
                            <td>{{$request->id}}</td>
                            <td>{{$request->owner_name}}</td>
                            <td>
                                @if($request->user_id)
                                    {{$request->user[0]->roles[0]->display_name}}
                                @else
                                    بازدیدکننده
                                @endif
                            </td>
                            <td>{{$request->owner_mobile_number}}</td>
                            <td>{{$request->areas[0]->text}}</td>
                            <td>{{$request->transfer[0]->text}}</td>
                            <td>{{$request->estateType[0]->text}}</td>
                            <td>{{$request->address}}</td>
                            <td>{{$request->area}}</td>
                            <td>{{$request->street_name}}</td>
                            <td>{{$request->plaque}}</td>
                            <td>{{$request->number_of_floor}}</td>
                            <td>{{$request->number_of_room}}</td>
                            <td>{{$request->apartment_unit}}</td>
                            <td>{{$request->year_of_construction}}</td>
                            <td>{{$request->direction[0]->text}}</td>
                            <td>{{$request->buy_price}}</td>
                            <td>{{$request->mortgage_price}}</td>
                            <td>{{$request->rent_price}}</td>
                            <td>{{$request->drescription}}</td>
                            <td>
                                @if($request->status == 1)
                                    تایید شده
                                @elseif($request->status == 2)
                                    واگذار شده
                                @endif
                            </td>
                            <td>
                                <form action="{{route('panel.estateRequest.unConfirmEstateRequest')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="estate_request_id" value="{{$request->id}}">
                                    <input class="btn btn-sm btn-danger" type="submit" value="عدم نمایش">
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary btn-sm"
                                   href="{{route('panel.estateRequest.updateEstateRequestForm',$request->id)}}">ویرایش</a>
                                <a class="btn btn-sm btn-danger btn-sm"
                                   href="{{route('panel.estateRequest.deleteEstateRequestForm',$request->id)}}">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div>
            {{$data['estateRequestList']->links()}}
        </div>
    </div>
@endsection
