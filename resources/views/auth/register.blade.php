@extends('layouts.app')

@section('content')
    <ul id="errors"></ul>
    <ul id="success"></ul>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="full_name" placeholder="نام و نام خانوادگی" value="{{old('full_name')}}">
        <input type="text" name="mobile_number" placeholder="شماره همراه" value="{{old('mobile_number')}}">
        <input type="text" name="code" placeholder="کد ارسالی" value="{{old('code')}}">
        <a href="#" id="send_code">ارسال کد</a>
        <input type="password" name="password" placeholder="کلمه عبور">
        <input type="password" name="password_confirmation" placeholder="تکرار کلمه عبور">
        <input type="submit" value="ثبت نام">
    </form>
    @if($errors->all())
        <hr>
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
    @endif
@endsection

@section('js')

@endsection
