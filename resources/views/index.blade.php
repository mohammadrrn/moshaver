<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>
        @hasSection('title')
            @yield('title')
        @endif
    </title>
</head>
<body>
@include('layouts.siteMenu')

@yield('content')

@include('layouts.footer')

<script src="{{asset('js/jq.js')}}"></script>
<script src="{{asset('js/cloudflare.js')}}"></script>
<script src="{{asset('js/rtlcss.com.js')}}"></script>
<script src="{{asset('js/js2.js')}}"></script>

@yield('js')

<script>
    $(".cancel").click(function () {
        // $(".add-support-item").addClass("add-support");
        $(".support").css("display", "block");
        $(".add-support-item").removeClass("add-support");
    });
</script>
</body>
</html>
