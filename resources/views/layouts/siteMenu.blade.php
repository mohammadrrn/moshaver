<header class="container-fluid">
    <div class="header">
        <div class="header-right">
            <img class="header-right-icon-moshaver" src="{{asset('icon/moshaver-007.png')}}">
            <ul>
                <li>
                    <a @if(Request::route()->getName() == 'index') class="mmad" @endif href="{{route('index')}}">
                        صفحه اصلی
                    </a>
                </li>
                <li>
                    <a href="{{route('search')}}"
                       @if(Request::route()->getName() == 'search' && count(Request::route()->parameters()) == 0) class="mmad" @endif >
                        جستجو
                    </a>
                </li>
                <li>
                    <a href="{{route('request.requestForm')}}"
                       @if(Request::route()->getName() == 'request.requestForm') class="mmad" @endif >
                        ثبت درخواست
                    </a>
                </li>
                <li>
                    <a href="{{route('request.estateForm')}}"
                       @if(Request::route()->getName() == 'request.estateForm') class="mmad" @endif>
                        ثبت آگهی
                    </a>
                </li>
                <li>
                    <a href="{{route('search','marked')}}"
                       @if(isset(Request::route()->parameters()['type']) &&  Request::route()->parameters()['type'] == 'marked') class="mmad" @endif>
                        نشان شده
                    </a>
                </li>
                <li>
                    <a href="{{route('trustedOfficesList')}}"
                       @if(Request::route()->getName() == 'trustedOfficesList') class="mmad" @endif >
                        دفاتر مورد اعتماد
                    </a>
                </li>
            </ul>
        </div>

        <div class="header-left">
            <div class="box-login">
                @if(auth()->user())
                    <a href="{{route('panel.index')}}">پنل کاربری</a>
                @else
                    <a href="{{route('login')}}">ورود  • عضویت</a>
                @endif
            </div>
            <div class="box-lang">
                <img class="box-lang-img-1" src="{{asset('icon/icons8_expand_arrow.svg')}}">
                <span>فارسی</span>
                <img class="box-lang-img-2" src="{{asset('icon/iran-icon.png')}}">
                <div class="box-lang-select">
                    <div class="box-lang-select-box box-lang-select-box-1 ">
                        <span>فارسی</span>
                        <img class="box-lang-img-2" src="{{asset('icon/iran-icon.png')}}">
                    </div>
                    <div class="box-lang-select-box box-lang-select-box-2">
                        <span>انگلیسی</span>
                        <img class="box-lang-img-2" src="{{asset('icon/icons8_great_britain_96px.png')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-responsive">
            <ul>
                <li>
                    <a href="{{route('index')}}">
                        صفحه اصلی
                    </a>
                </li>
                <li>
                    <a href="{{route('search')}}">
                        جستجو
                    </a>
                </li>
                <li>
                    <a href="{{route('request.requestForm')}}">
                        ارسال درخواست
                    </a>
                </li>
                <li>
                    <a href="{{route('request.estateForm')}}">
                        ثبت ملک
                    </a>
                </li>
                <li>
                    <a href="{{route('search','marked')}}">
                        نشان شده
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
