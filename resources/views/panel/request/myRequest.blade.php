@extends('layouts.app')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                        <span class="title-services">
                           لیست درخواست های من
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
                        <th>منطقه</th>
                        <th>نوع واگذاری</th>
                        <th>نوع ملک</th>
                        <th>آدرس</th>
                        <th>متراژ</th>
                        <th>مبلغ خرید</th>
                        <th>مبلغ رهن</th>
                        <th>مبلغ اجاره</th>
                        <th>توضیحات</th>
                        <th>وضعیت</th>
                    </tr>
                    @foreach($data['estateRequestList'] as $request)
                        <tr>
                            <td>{{$request->id}}</td>
                            <td>{{$request->areas[0]->text}}</td>
                            <td>{{$request->transfer[0]->text}}</td>
                            <td>{{$request->estateType[0]->text}}</td>
                            <td>{{$request->range_of_address}}</td>
                            <td>{{$request->rang_of_area}}</td>
                            <td>{{$request->buy_price}}</td>
                            <td>{{$request->mortgage_price}}</td>
                            <td>{{$request->rent_price}}</td>
                            <td>{{$request->description}}</td>
                            <td>
                                @if($request->status == 0)
                                    <span class="bg-danger text-white p-1">تایید نشده</span>
                                @elseif($request->status == 1)
                                    <span class="bg-success text-white p-1">تایید شده</span>
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
