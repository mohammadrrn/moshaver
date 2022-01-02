<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        ul.main-menu li {
            cursor: pointer;
        }

        ul.main-menu li ul {
            display: none;
        }
    </style>
</head>
<body>
<ul class="main-menu">
    <li>
        Item - 1
        <ul>
            <li>item 1</li>
            <li>item 2</li>
            <li>item 3</li>
        </ul>
    </li>
    <li>
        Item - 2
        <ul>
            <li>item 1</li>
        </ul>
    </li>
    <li>
        Item - 3
        <ul>
            <li>item 1</li>
            <li>item 2</li>
        </ul>
    </li>
</ul>
<script src="{{asset('js/jq.js')}}"></script>
<script>
    $('ul.main-menu li').click(function () {
        $(this).find('ul').slideToggle();
    });
</script>
</body>
</html>
