<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تغییر کلمه عبور</title>
</head>
<body>
<form method="post" action="{{route('resetPassword')}}">
    @csrf
    <input type="text" name="password" placeholder="کلمه عبور جدید خود را وارد نمایید">
    <input type="hidden" name="mobile_number" value="{{$data['mobile_number']}}">
    <input type="hidden" name="security_code" value="{{$data['security_code']}}">
    <input type="text" name="repeat_password" placeholder="تکرار کلمه عبور جدید خود را وارد نمایید">
    <input type="submit" value="تغییر کلمه عبور">
</form>
</body>
</html>
