@extends('layouts.app')

@section('title','لیست کاربران')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                        <span class="title-services">
                           کاربران
                        </span>
            </div>
            <div class="col-12">
                <form action="{{route('panel.search','usersList')}}">
                    <div class="row list-moshaver-top">
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="کد کاربر" name="code">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="نام کاربر" name="full_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="کد ملی کاربر" name="national_code">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="شماره همراه" name="mobile_number">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 ">
                            <div class="list-request-box-group">
                                <select class="form-select form-select" aria-label="Default select example" name="plan">
                                    <option selected disabled>نوع اشتراک</option>
                                    @foreach($data['plan'] as $plan)
                                        <option value="{{$plan->id}}">{{$plan->title}}</option>
                                    @endforeach
                                    <option value="no-plan">بدون اشتراک</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 ">
                            <div class="list-request-box-group">
                                <select class="form-select form-select" aria-label="Default select example"
                                        name="status">
                                    <option selected disabled>وضعیت کاربر</option>
                                    <option value="1">فعال</option>
                                    <option value="0">غیر فعال</option>
                                    <option value="2">مسدود</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="list-request-box-group-button">
                                <button class=" btn-block">جستجو</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 table list-customer-table">
                <table>
                    <tr>
                        <th>کد کاربر</th>
                        <th>نام و نام خانوادگی</th>
                        <th>کد ملی</th>
                        <th>شماره تماس</th>
                        <th>نقش</th>
                        <th>اشتراک</th>
                        <th>وضعیت</th>
                        <th>پروفایل</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($data['usersList'] as $user)
                        @if($user->roles[0]->name != 'admin')
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->national_code}}</td>
                                <td>{{$user->mobile_number}}</td>

                                <td>
                                    @isset($user->role[0]->display_name)
                                        {{$user->role[0]->display_name}}
                                    @else
                                        بدون نقش
                                    @endisset
                                </td>
                                <td>
                                    @isset($user->plan[0]->title)
                                        {{$user->plan[0]->title}}
                                    @else
                                        بدون اشتراک
                                    @endisset
                                </td>
                                <td>
                                    @switch($user->status)
                                        @case(1)
                                        فعال
                                        @break
                                        @case(2)
                                        بلاک
                                        @break
                                        @default
                                        غیرفعال
                                    @endswitch
                                </td>
                                <td>
                                    @if($user->profileStatus == 1)
                                        کامل
                                    @else
                                        ناقص
                                    @endisset
                                </td>
                                <td>
                                    @switch($user->status)
                                        @case(1)
                                        <form method="post" action="{{route('panel.users.inactive')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="submit" class="btn btn-danger btn-sm" value="مسدود سازی">
                                        </form>
                                        @break
                                        @case(2)
                                        <form method="post" action="{{route('panel.users.active')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="submit" class="btn btn-success btn-sm" value="آزاد سازی">
                                        </form>
                                        @break
                                        @default
                                        <form method="post" action="{{route('panel.users.inactive')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="submit" class="btn btn-danger btn-sm" value="مسدود سازی">
                                        </form>
                                    @endswitch
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        <div>
            {{$data['usersList']->links()}}
        </div>
    </div>
@endsection


