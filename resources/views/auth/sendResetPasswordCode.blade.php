<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <title>فراموشی رمز عبور</title>

    <style>
        * {
            direction: ltr;
        }
    </style>
</head>
<!-- mohammadreza rashidi nejad -->

<body>
<div class="box-body-login">

    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="post" action="{{route('resetPasswordForm')}}">

                <h1 class="title-page">فراموشی رمز عبور</h1>
                <br>
                <span class="small">کد تایید برای شماره {{$data['mobile_number']}} ارسال شده</span>
                <br>
                @csrf
                <input type="text" name="code" placeholder="کد ارسال شده را وارد نمایید">
                <input type="hidden" name="mobile_number" value="{{$data['mobile_number']}}">
                <br>
                <button type="submit">تغییر رمز عبور</button>
                @csrf
                <div class="login-alert">
                    @if($errors->all())
                        <hr>
                        @foreach($errors->all() as $error)
                            {{$error}}<br>
                        @endforeach
                    @endif
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <!-- <img style="width:100%" src="../img/bg-img-item-result.png" alt=""> -->
                    <h1>قدم دوم</h1>
                    <p>کد ارسال شده به شماره همراه خود را وارد نمایید</p>
                    <!-- <hr> -->
                    <!-- <hr> -->
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('js/jq.js')}}"></script>
<script src="{{asset('js/cloudflare.js')}}"></script>
<script src="{{asset('js/rtlcss.com.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>

<script>
    $("#send_code").click(function (event) {
        event.preventDefault();
        let mobile_number = $("input[name=mobile_number]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/sendVerificationCode",
            type: "POST",
            data: {
                mobile_number: mobile_number.toString(),
                _token: _token
            },
            success: function (response) {
                if (response) {
                    $('#success').text('');
                    $('#success').append('<li>' + response.message + '</li>');
                }
            },
            error: function (error) {
                $('#errors').text('');
                for (var i = 0; i < error.responseJSON.errors.mobile_number.length; i++) {
                    $('#errors').append('<li>' + error.responseJSON.errors.mobile_number[i] + '</li>');
                }
            }
        });
    });
</script>

</body>

</html>
