@extends('layouts.app')

@section('title','افزودن یادآوری')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.reminder.addReminder')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>افزودن یادآوری</span>
                    </div>
                    <div class="group">
                        <input type="text" name="reminder_title" value="{{old('reminder_title')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>عنوان یادآوری</label>
                    </div>
                    <div class="group">
                        <input type="text" name="reminder_date" value="{{old('reminder_date')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>تاریخ یادآوری</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ثبت یادآوری</button>
                </form>
            </div>
        </div>
    </div>
@endsection
