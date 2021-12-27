@extends('layouts.app')

@section('title','افزدن نویسنده')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.writer.addWriter')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>افزودن نویسنده جدید</span>

                    </div>
                    <div class="group">
                        <input type="text" name="full_name" value="{{old('full_name')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="national_code" value="{{old('national_code')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کد ملی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="mobile_number" value="{{old('mobile_number')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>
                    <div class="group">
                        <select name="area_id">
                            <option disabled selected>انتخاب منطقه</option>
                            @foreach($data['areas'] as $area)
                                <option value="{{$area->id}}">{{$area->text}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="group">
                        <input type="text" name="password"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کلمه عبور</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ثبت نویسنده</button>
                </form>
            </div>
            <div class="col-md-12 col-lg-6 add-moshaver">
                <div class="form">
                    <div class="form-top">
                        <span>جستجوی عملکرد</span>

                    </div>
                    <form action="{{route('panel.writer.searchAction')}}" method="post">
                        @csrf
                        <div class="group">
                            <input type="text" name="code"/>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>کد ملک</label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block moshaver-insert">جستجوی عملکرد</button>
                    </form>
                </div>
            </div>

            <div class="col-md-12  list-moshaver">
                <div class="row">
                    @foreach($data['writerList'] as $writer)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="list-moshaver-item">
                            <!--                                <img src="{{asset('icon/PanelAdmin/user-moshaver.jpg')}}" alt="">-->
                                <div class="add-moshaver-box-specifications justify-content-center">
                                    <span>کد : {{$writer->id}} / {{$writer->area_id}}</span>
                                </div>
                                <span>تعداد آگهی های ثبت شده : {{count($writer->estateRequest)}}</span>
                                <span>{{$writer->full_name}}</span>
                                <form method="post"
                                      action="{{($writer->status == 2 || $writer->status == 0) ? route('panel.writer.active',$writer->id) : route('panel.writer.inactive',$writer->id)}}">
                                    @csrf
                                    @if($writer->status == 1 || $writer->status == 0)
                                        <button class="btn btn-sm btn-danger">مسدود سازی</button>
                                    @else
                                        <button class="btn btn-sm btn-success">آزاد سازی</button>
                                    @endif
                                    <a href="{{route('panel.writer.writerActions',$writer->id)}}"
                                       class="btn btn-sm btn-primary">مشاهده
                                        عملکرد</a>
                                    <a href="{{route('panel.writer.updateForm',$writer->id)}}"
                                       class="btn btn-sm btn-warning">ویرایش</a>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
