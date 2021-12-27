<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فرم فراموشی رمز عبور</title>
</head>
<body>
@foreach($errors->all() as $error)
    {{$error}}
@endforeach
<form method="post" action="{{route('sendResetPasswordCode')}}">
    @csrf
    <input type="text" name="mobile_number" placeholder="شماره همراه خود را وارد نمایید">
    <input type="submit" value="ارسال کد">
</form>
</body>
</html>
