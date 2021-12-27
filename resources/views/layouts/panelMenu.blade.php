<ul class="panel-nav-ul">
    <li>
        <a href="{{route('panel.index')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/home.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/home-w.svg')}}" alt="">
            <span>پنل اصلی</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.reminder.addReminderForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>افزودن یادآوری</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('index')}}" target="_blank">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/home.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/home-w.svg')}}" alt="">
            <span>مشاهده سایت</span>
        </a>
    </li>

    <li>
        <a href="{{route('panel.profile')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8_staff copy.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8_staff-white.png')}}" alt="">
            <span>ویرایش پروفایل</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.writer.addWriterForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8_staff copy.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8_staff-white.png')}}" alt="">
            <span>نویسندگان</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.trustedOffices.addTrustedOfficesForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8_staff copy.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8_staff-white.png')}}" alt="">
            <span>دفاتر مورد اعتماد</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.users.usersList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8_staff copy.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8_staff-white.png')}}" alt="">
            <span>لیست کاربران</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.subscription.plans')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-add-basket-60.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8_Add_Basket.png')}}" alt="">
            <span>خرید اشتراک</span>
        </a>
    </li>
    <hr/>
    <li>
        <a href="{{route('request.estateForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>ثبت ملک</span>
        </a>
    </li>
    <li>
        <a href="{{route('request.requestForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-important-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-important-file-64-w.png')}}" alt="">
            <span>ثبت درخواست</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.estateRequest.myEstateRequest')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>لیست ثبت ملک های من</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.estateRequest.confirmedEstateRequestList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>لیست ثبت ملک های تایید شده</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.estateRequest.unconfirmedEstateRequestList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>لیست ثبت ملک های تایید نشده</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.request.myRequest')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>لیست درخواست های من</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.request.confirmedRequestList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>لیست درخواست های تایید شده</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.request.unconfirmedRequestList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8-happy-file-64.png')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/icons8-happy-file-64-w.png')}}" alt="">
            <span>لیست درخواست های تایید نشده</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.zoonkan.createZoonkanForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>زونکن</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.contact.contactList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>دفترچه تلفن</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.invoice.invoicesList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>لیست تراکنش ها</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.cession.reportsList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>لیست گزارشات واگذاری</span>
        </a>
    </li>
    <hr>
    <li>
        <a href="{{route('panel.area.addAreaForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>افزودن منطقه</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.area.areaList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>لیست مناطق</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.city.addCityForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>افزودن شهر</span>
        </a>
    </li>
    <li>
        <a href="{{route('panel.city.cityList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/video_clip.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/video_clip-white.svg')}}" alt="">
            <span>لیست شهرها</span>
        </a>
    </li>
    <!--
        <li>
            <div>
                <img class="panel-nav-img-gry" src="../icon/PanelAdmin/video_clip.svg" alt="">
                <img class="panel-nav-img-white" src="../icon/PanelAdmin/video_clip-white.svg" alt="">
                <span>ویدئو آموزشی</span>
            </div>
        </li>
        <hr>-->


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
