@extends('layouts.app')

@section('title','ویرایش منطقه')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.area.editArea',$data['area']->id)}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>ویرایش منطقه</span>
                    </div>
                    <div class="group">
                        <input type="text" name="area_text" value="{{$data['area']->text}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام منطقه</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ویرایش منطقه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
