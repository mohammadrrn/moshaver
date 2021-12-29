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
                        <input type="text" autocomplete="off" name="reminder_date" id="reminder_date_cal"
                               value="{{old('reminder_date')}}"
                               placeholder="انتخاب تاریخ یادآوری"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">ثبت یادآوری</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
    <script>
        kamaDatepicker('reminder_date_cal');
    </script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/kamadatepicker.min.css')}}">
@endsection
