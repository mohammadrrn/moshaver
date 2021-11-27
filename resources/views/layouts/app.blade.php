<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/panel.css')}}">
    <title>Document</title>
</head>
<body>
<header class="container-fluid">
    <div class="row">
        <div class="col-6 header-right">
            <img class="header-img-logo" src="{{asset('icon/PanelAdmin/header-logo.png')}}" alt="">
            <div class="header-box-img header-box-img-1">
                <img class="header-img-logo" src="{{asset('icon/PanelAdmin/icons8_notification.png')}}" alt="">
                <div class="main-content">
                    <div class="blinker-container">
                        <div class="blinker blinker-six">
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-box-img">
                <img class="header-img-logo" src="{{asset('icon/PanelAdmin/icons8_group_message.png')}}" alt="">
                <div class="main-content">
                    <div class="blinker-container">
                        <div class="blinker blinker-six">
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 header-left">
            <a href="send-request.html" class="header-left-box-span">
                <div class="header-left-span-left-alert header-left-span-left-alert-1"></div>
                <span class="header-left-span-left header-left-send">ارسال درخواست</span>
            </a>
            <a href="send-product.html" class="header-left-box-span">
                <div class="header-left-span-left-alert header-left-span-left-alert-2"></div>
                <span class="header-left-span-left header-left-new-ad">ثبت ملک</span>
            </a>
            <div class="box-lang header-left-profile">
                <img class="box-lang-img-1" src="../icon/PanelAdmin/down.png">
                <span>محمد رضا رشیدی</span>
                <div class="box-lang-select">
                    <div class="box-lang-select-box box-lang-select-box-1">
                        <a href="user.html">ویرایش پروفایل</a>
                    </div>
                    <div class="box-lang-select-box box-lang-select-box-2">
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button class="btn-block">خروج</button>
                        </form>
                    </div>
                </div>
            </div>
            <img class="header-left-male-user" src="../icon/PanelAdmin/icons8-user-male-30.png">
        </div>
    </div>
</header>


<main class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-2 panel-nav">
            <img class="panel-nav-icon-menu" src="../icon/PanelAdmin/icons8_menu.png" alt="">
            <ul class="panel-nav-ul">
                <li>
                    <a href="{{route('index')}}">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/home.svg" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/home-w.svg" alt="">
                        <span>صفحه اصلی</span>
                    </a>
                </li>

                <li>
                    <a href="user.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8_staff copy.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8_staff-white.png" alt="">
                        <span>ویرایش پروفایل</span>
                    </a>
                </li>
                <li>
                    <a href="add-moshaver.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8_staff copy.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8_staff-white.png" alt="">
                        <span>نویسنده</span>
                    </a>
                </li>
                <li>
                    <a href="add-trusted-offices.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8_staff copy.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8_staff-white.png" alt="">
                        <span>دفاتر مورد اعتماد</span>
                    </a>
                </li>
                <li>
                    <a href="list-customer.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8_staff copy.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8_staff-white.png" alt="">
                        <span>لیست مشتریان</span>
                    </a>
                </li>
                <li>
                    <a href="subscription.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-add-basket-60.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8_Add_Basket.png" alt="">
                        <span>خرید اشتراک</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a href="send-product.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-happy-file-64.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8-happy-file-64-w.png" alt="">
                        <span>ثبت ملک</span>
                    </a>
                </li>
                <li>
                    <a href="send-request.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-important-file-64.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8-important-file-64-w.png" alt="">
                        <span>ثبت درخواست</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a href="list-product.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-happy-file-64.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8-happy-file-64-w.png" alt="">
                        <span>نمایش ثبت ملک</span>
                    </a>
                </li>
                <li>
                    <a href="my-list-product.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-happy-file-64.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8-happy-file-64-w.png" alt="">
                        <span>نمایش ثبت ملک من</span>
                    </a>
                </li>
                <li>
                    <a href="list-request.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-important-file-64.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8-important-file-64-w.png" alt="">
                        <span>نمایش درخواست</span>
                    </a>

                </li>
                <li>
                    <a href="my-list-request.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/icons8-important-file-64.png" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/icons8-important-file-64-w.png" alt="">
                        <span>نمایش درخواست من</span>
                    </a>

                </li>
                <hr>
                <li>
                    <a href="zoonckan.html">
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/video_clip.svg" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/video_clip-white.svg" alt="">
                        <span>زونکن</span>
                    </a>
                </li>
                <li>
                    <div>
                        <img class="panel-nav-img-gry" src="../icon/PanelAdmin/video_clip.svg" alt="">
                        <img class="panel-nav-img-white" src="../icon/PanelAdmin/video_clip-white.svg" alt="">
                        <span>ویدئو آموزشی</span>
                    </div>
                </li>
                <hr>


                <li>
                    <div>
                        <!-- <img src="../icon/PanelAdmin/icons8_settings.png" alt=""> -->
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button class="btn-block">خروج</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        {{session('success')}}
        @yield('content')
    </div>
</main>


<script src="../js/jq.js"></script>
<script src="../js/cloudflare.js"></script>
<script src="../js/rtlcss.com.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../js/js2.js"></script>
<script>
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
</script>
</body>
</html>
