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
    <title>ورود به ناحیه کاربری</title>
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
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="title-page">ثبت‌ نام</h1>
                @if($errors->all())
                    <br>
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                            <span class="small">{{$error}}</span><br>
                        @endforeach
                    </div>
                @endif
            <!-- <hr> -->
                <!-- <div class="social-container">
                    <a href="#" class="social social-1"><img class="social-img" src="icon/icons8-google-24.png"></a>
                    <a href="#" class="social social-2"><img class="social-img" src="icon/icons8-github-24.png"></a>
                    <a href="#" class="social social-3"><img class="social-img" src="icon/icons8-facebook-24.png"></a>
                </div> -->

                <input type="text" name="full_name" placeholder="نام و نام خانوادگی" value="{{old('full_name')}}">

                <input type="text" name="mobile_number" maxlength="11" placeholder="شماره همراه"
                       value="{{old('mobile_number')}}">

                <div class="box-send-number">
                    <span class="login-send-code" id="send_code"
                          style="position: absolute;top: 15px;left:10px;cursor: pointer">ارسال کد</span>

                    <div class="js-counter"></div>
                    <input type="text" name="code" maxlength="4" placeholder="کد ارسالی" value="{{old('code')}}">

                </div>
                <input type="password" name="password" placeholder="کلمه عبور">
                <input type="password" name="password_confirmation" placeholder="تکرار کلمه عبور">
                {!! NoCaptcha::display() !!}

                <div class="box-button">
                    <button>ثبت نام</button>
                    <button class="ghost-responsiv" id="signIn-responsiv">ورود</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                <h1 class="title-page">ورود به ناحیه کاربری</h1>
                <br>
                @if($errors->all())
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                            <span class="small">{{$error}}</span><br>
                        @endforeach
                    </div>
                @endif
                @csrf
                <input type="text" name="mobile_number" maxlength="11" placeholder="شماره همراه">
                <input type="password" name="password" placeholder="کلمه عبور">
                <br>
                <div class="box-remember">
                    <input class="box-remember-checkbox" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        {{ __('مرا به خاطر بسپار') }}
                    </label>
                </div>
                {!! NoCaptcha::display() !!}
                <div class="box-button">
                    <button type="submit">ورود</button>
                    <button class="ghost-responsiv" id="signUp-responsiv">ثبت نام</button>
                </div>
                <a href="{{route('forgetPassword')}}">فراموشی رمز عبور</a>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>مشاور 007</h1>
                    <p>لطفااطلاعات شخصی خود را بادقت وارد کنید</p>
                    <button class="ghost" id="signIn">ورود</button>
                    <a class="back-home" href="{{route('index')}}">بازگشت به صفحه اصلی</a>
                </div>
                <div class="overlay-panel overlay-right">
                    <!-- <img style="width:100%" src="../img/bg-img-item-result.png" alt=""> -->
                    <h1>مشاور 007</h1>
                    <p>مشخصات خود را وارد کنید</p>
                    <!-- <hr> -->
                    <!-- <hr> -->
                    <button class="ghost" id="signUp">ثبت نام</button>
                    <a class="back-home" href="{{route('index')}}">بازگشت به صفحه اصلی</a>
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
{!! NoCaptcha::renderJs() !!}
</body>

</html>
