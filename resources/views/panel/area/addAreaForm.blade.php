@extends('layouts.app')

@section('title','افزودن منطقه')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.area.addArea')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>افزودن منطقه</span>
                    </div>
                    <div class="group">
                        <input type="text" name="area_text" value="{{old('area_text')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام منطقه</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ثبت منطقه جدید</button>
                </form>
            </div>
        </div>
    </div>
@endsection
