<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/panel.css')}}">
    @yield('css')
    <title>
        @hasSection('title')
            @yield('title')
        @else
            پنل مدیریت
        @endif
    </title>
</head>
<body>
<header class="container-fluid">
    <div class="row">
        <div class="col-6 header-right">
            <img class="header-img-logo" src="{{asset('icon/PanelAdmin/header-logo.png')}}" alt="">
            <div class="header-box-img header-box-img-1">
                <a href="{{route('panel.notification.notificationList')}}">
                    <img class="header-img-logo" src="{{asset('icon/PanelAdmin/icons8_notification.png')}}" alt="">
                </a>
                @if(count(auth()->user()->unreadNotifications) > 0)
                    <div class="main-content">
                        <div class="blinker-container">
                            <div class="blinker blinker-six">
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6 header-left">
            <a href="{{route('request.requestForm')}}" class="header-left-box-span">
                <div class="header-left-span-left-alert header-left-span-left-alert-1"></div>
                <span class="header-left-span-left header-left-send">ارسال درخواست</span>
            </a>
            <a href="{{route('request.estateForm')}}" class="header-left-box-span">
                <div class="header-left-span-left-alert header-left-span-left-alert-2"></div>
                <span class="header-left-span-left header-left-new-ad">ثبت ملک</span>
            </a>
            <div class="box-lang header-left-profile">
                <img class="box-lang-img-1" src="{{asset('icon/PanelAdmin/down.png')}}">
                <span>{{auth()->user()->full_name}}</span>
                <div class="box-lang-select">
                    <div class="box-lang-select-box box-lang-select-box-1">
                        <a href="{{route('panel.profile')}}">ویرایش پروفایل</a>
                    </div>
                    <div class="box-lang-select-box box-lang-select-box-2">
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button class="btn-block">خروج</button>
                        </form>
                    </div>
                </div>
            </div>
            <img class="header-left-male-user" src="{{asset('icon/PanelAdmin/icons8-user-male-30.png')}}">
        </div>
    </div>
</header>


<main class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-2 panel-nav">
            <img class="panel-nav-icon-menu" src="{{asset('icon/PanelAdmin/icons8_menu.png')}}" alt="">
            @include('layouts.panelMenu')
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible alert-message" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
                </button>
                <span>
                <strong>پیام : </strong>
                {{session('success')}}
            </span>
            </div>
        @endif
        @if($errors->all())
            <div class="alert alert-danger alert-dismissible alert-message" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
                </button>
                <span>
                <strong>خطا : </strong>
                @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
            </span>
            </div>
        @endif
        @yield('content')
    </div>
</main>


<script src="{{asset('js/jq.js')}}"></script>
<script src="{{asset('js/cloudflare.js')}}"></script>
<script src="{{asset('js/rtlcss.com.js')}}"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
<script src="{{asset('js/js2.js')}}"></script>
@yield('js')
<!--<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["1400/1", "1400/2", "1400/3", "1400/4", "1400/5", "1400/6", "1400/7", "1400/8", "1400/9", "1400/10", "1400/11", "1400/12"],
            datasets: [{
                label: 'chart',
                data: [12, 19, 3, 5, 2, 3, 10, 20, 15, 14, 2, 10],
                borderColor: [
                    '#70afdd'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>-->
</body>
</html>
