@extends('layouts.app')

@section('title','افزودن شهر')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.city.addCity')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>افزودن منطقه</span>
                    </div>
                    <div class="group">
                        <input type="text" name="city_text" value="{{old('city_text')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام شهر</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ثبت شهر جدید</button>
                </form>
            </div>
        </div>
    </div>
@endsection
