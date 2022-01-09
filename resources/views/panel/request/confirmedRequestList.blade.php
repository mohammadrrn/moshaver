@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                        <span class="title-services">
                           لیست درخواست های تایید شده
                        </span>
            </div>
            <div class="col-12">
                <form action="{{route('panel.search','confirmedRequestList')}}">
                    <div class="row list-moshaver-top">
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="نام مالک" name="full_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="شماره تماس" name="mobile_number">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="کد درخواست" name="code">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group-button">
                                <button class=" btn-block">جستجو</button>
                            </div>
                        </div>
                    </div>
                </form>
                تعداد درخواست ها : {{count($data['requestList'])}} مورد
            </div>
            <div class="col-12 table list-customer-table">
                <table>
                    <tr>
                        <th>کد درخواست</th>
                        <th>نام و نام خانوادگی</th>
                        <th>شماره تماس</th>
                        <th>منطقه</th>
                        <th>نوع ملک</th>
                        <th>حدود آدرس</th>
                        <th>حدود متراژ درخواستی</th>
                        <th>قیمت خرید</th>
                        <th>قیمت رهن</th>
                        <th>قیمت اجاره</th>
                        <th>توضیحات</th>
                        <th>عدم نمایش</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($data['requestList'] as $request)
                        <tr>
                            <td>{{$request->id}}</td>
                            <td>{{$request->full_name}}</td>
                            <td>{{$request->mobile_number}}</td>
                            <td>{{$request->areas[0]->text}}</td>
                            <td>{{$request->estateType[0]->text}}</td>
                            <td>{{$request->range_of_address}}</td>
                            <td>{{$request->rang_of_area}}</td>
                            <td>{{($request->buy_price != 0 ) ? number_format($request->buy_price) . ' تومان ' : 0}}</td>
                            <td>{{($request->mortgage_price != 0 ) ? number_format($request->mortgage_price) . ' تومان ' : 0}}</td>
                            <td>{{($request->rent_price != 0 ) ? number_format($request->rent_price) . ' تومان ' : 0}}</td>
                            <td>{{$request->drescription}}</td>
                            <td>
                                <form action="{{route('panel.request.unConfirmRequest')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{$request->id}}">
                                    <input class="btn btn-sm btn-danger btn-sm" type="submit" value="عدم نمایش">
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary btn-sm"
                                   href="{{route('panel.request.updateRequestForm',$request->id)}}">ویرایش</a>
                                <a class="btn btn-sm btn-danger btn-sm"
                                   href="{{route('panel.request.deleteRequestForm',$request->id)}}">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div>
            {{$data['requestList']->links()}}
        </div>
    </div>
@endsection
