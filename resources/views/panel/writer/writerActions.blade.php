@extends('layouts.app')

@section('title','عملکرد نویسنده')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                        <span class="title-services">
                           عملکرد نویسنده
                        </span>
            </div>
            <br>
            <br>
            <div class="col-12">
                <p>
                    تعداد آگهی های ثبت شده : {{$data['countActions']['insert']}}
                </p>
                <p>
                    تعداد آگهی های ویرایش شده : {{$data['countActions']['update']}}
                </p>
                <p>
                    تعداد آگهی های حذف شده : {{$data['countActions']['delete']}}
                </p>
                <p>
                    تعداد آگهی های تایید شده : {{$data['countActions']['confirmed']}}
                </p>
            </div>
            <div class="col-12 table list-customer-table">
                <table>
                    <tr>
                        <th>کد تغییر</th>
                        <th>کد آگهی</th>
                        <th>نوع آگهی</th>
                        <th>عملیات</th>
                        <th>تاریخ و ساعت</th>
                    </tr>
                    @foreach($data['actions'] as $action)
                        <tr>
                            <td>{{$action->id}}</td>
                            <td>{{$action->request_id}}</td>
                            <td>
                                @if($action->request_model == 'estate_requests')
                                    آگهی ثبت ملک
                                @endif
                            </td>
                            <td>
                                @switch($action->action_type)
                                    @case('insert')
                                    <span class="bg-primary btn-sm text-white">ثبت آگهی جدید</span>
                                    @break
                                    @case('confirmed')
                                    <span class="bg-success btn-sm text-white">تایید آگهی</span>
                                    @break
                                    @case('unconfirmed')
                                    <span class="bg-danger btn-sm text-white">رد تایید آگهی</span>
                                    @break
                                    @case('update')
                                    <span class="bg-info btn-sm text-white">ویرایش آگهی</span>
                                    @break
                                    @case('delete')
                                    <span class="bg-danger btn-sm text-white">حذف آگهی</span>
                                    @break
                                    @default
                                    ****
                                @endswitch
                            </td>
                            <td>
                                <span class="bg-dark text-white p-1 mr-1 rounded">
                                    {{Morilog\Jalali\Jalalian::fromDateTime($action->created_at)->format('%Y/%m/%d')}}
                                </span>
                                <span>
                                    {{Morilog\Jalali\Jalalian::fromDateTime($action->created_at)->format('H:i:s')}}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div>
            {{$data['actions']->links()}}
        </div>
    </div>
@endsection
