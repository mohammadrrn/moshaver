@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                        <span class="title-services">
                           لیست درخواست های ثبت ملک من
                        </span>
            </div>
            <div class="col-12">
                <form action="{{route('panel.search','myEstateRequest')}}">
                    <div class="row list-moshaver-top">
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="نام مالک" name="owner_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="شماره تماس" name="owner_mobile_number">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="کد ملک" name="code">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group-button">
                                <button class=" btn-block">جستجو</button>
                            </div>
                        </div>
                    </div>
                </form>
                تعداد آگهی ها : {{count($data['estateRequestList'])}} مورد
            </div>
            <div class="col-12 table list-customer-table">
                <table>
                    <tr>
                        <th>کد درخواست</th>
                        <th>نام مالک</th>
                        <!--                        <th>منطقه</th>-->
                        <th>نوع واگذاری</th>
                        <th>نوع ملک</th>
                        <th>آدرس</th>
                        <th>متراژ</th>
                        <!--                        <th>نام کوچه و خیابان</th>-->
                        <!--                        <th>پلاک</th>
                                                <th>تعداد طبقه</th>
                                                <th>تعداد اتاق</th>
                                                <th>تعداد واحد</th>
                                                <th>سال ساخت</th>
                                                <th>جهت ملک</th>
                                                <th>مبلغ خرید</th>
                                                <th>مبلغ رهن</th>
                                                <th>مبلغ اجاره</th>-->
                        <th>دلیل رد تایید</th>
                        <th>جزئیات</th>
                        <th>وضعیت</th>
                    </tr>
                    @foreach($data['estateRequestList'] as $request)
                        <tr>
                            <td>{{$request->id}}</td>
                            <td>{{$request->owner_name}}</td>
                            <td>{{$request->transfer[0]->text}}</td>
                            <td>{{$request->estateType[0]->text}}</td>
                            <td>{{$request->address}}</td>
                            <td>{{$request->area}}</td>
                        <!--                            <td>{{$request->street_name}}</td>-->
                        <!--                            <td>{{$request->plaque}}</td>
                            <td>{{$request->number_of_floor}}</td>
                            <td>{{$request->number_of_room}}</td>
                            <td>{{$request->apartment_unit}}</td>
                            <td>{{$request->year_of_construction}}</td>
                            <td>{{$request->direction[0]->text}}</td>
                            <td>{{($request->buy_price != 0 ) ? number_format($request->buy_price) . ' تومان ' : 0}}</td>
                            <td>{{($request->mortgage_price != 0 ) ? number_format($request->mortgage_price) . ' تومان ' : 0}}</td>
                            <td>{{($request->rent_price != 0 ) ? number_format($request->rent_price) . ' تومان ' : 0}}</td>-->
                            <td>
                                @if($request->reason != '')
                                    {{$request->reason}}
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                   href="{{route('panel.estateRequest.updateEstateRequestForm',$request->id)}}">جزئیات</a>
                            </td>
                            <td>
                                @if($request->status == 0)
                                    <span class="bg-danger text-white p-1">تایید نشده</span>
                                @elseif($request->status == 1)
                                    <span class="bg-success text-white p-1">تایید شده</span>
                                @elseif($request->status == 2)
                                    <span class="bg-primary text-white p-1">واگذار شده</span>
                                @elseif($request->status == 3)
                                    <span class="bg-warning text-white p-1">رد شده</span>
                                @else
                                    نامشخص
                                @endif
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
