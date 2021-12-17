@extends('layouts.app')

@section('title','ویرایش نویسنده')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.writer.update')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>ویرایش نویسنده</span>

                    </div>
                    <input type="hidden" value="{{$data['writerId']}}" name="writer_id">
                    <div class="group">
                        <input type="text" name="full_name" value="{{$data['writer']->full_name}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="national_code" value="{{$data['writer']->national_code}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کد ملی</label>
                    </div>
                    <div class="group">
                        <input type="text" name="mobile_number" value="{{$data['writer']->mobile_number}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره همراه</label>
                    </div>

                    <div class="group">
                        <input type="text" name="email" value="{{$data['writer']->email}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>ایمیل</label>
                    </div>
                    <div class="group">
                        <input type="text" name="password"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>کلمه عبور</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ویرایش نویسنده</button>
                </form>
            </div>
        </div>
    </div>
@endsection
