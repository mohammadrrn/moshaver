<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تایید کد ارسالی</title>
</head>
<body>
کد تایید برای شماره {{$data['mobile_number']}} ارسال شده
<form method="post" action="{{route('resetPasswordForm')}}">
    @csrf
    <input type="text" name="code" placeholder="کد ارسال شده را وارد نمایید">
    <input type="hidden" name="mobile_number" value="{{$data['mobile_number']}}">
    <input type="submit" value="تایید کد">
</form>
</body>
</html>
