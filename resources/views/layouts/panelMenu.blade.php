<ul class="panel-nav-ul">
    <li class="mt-2 panel-nav-ul-li">
        <a href="{{route('panel.index')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/home.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/home-w.svg')}}" alt="">
            <span>پنل اصلی</span>
        </a>
    </li>
    <hr>
    <li class="panel-nav-ul-li">
        <a href="{{route('index')}}" target="_blank">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/site.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/site-w.svg')}}" alt="">
            <span>مشاهده سایت</span>
        </a>
    </li>
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.profile')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/profile.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/profile-w.svg')}}" alt="">
            <span>ویرایش پروفایل</span>
        </a>
    </li>
    <hr>
    @permission('add-reminder')
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.reminder.addReminderForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/reminder.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/reminder-w.svg')}}" alt="">
            <span>افزودن یادآوری</span>
        </a>
    </li>
    @endpermission
    @permission('writer-list')
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.writer.addWriterForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/writer.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/writer-w.svg')}}" alt="">
            <span>نویسندگان</span>
        </a>
    </li>
    @endpermission
    @permission('users-list')
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.users.usersList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/users.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/users-w.svg')}}" alt="">
            <span>لیست کاربران</span>
        </a>
    </li>
    @endpermission
    @permission('trusted-offices-list')
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.trustedOffices.addTrustedOfficesForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/trusted.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/trusted-w.svg')}}" alt="">
            <span>دفاتر مورد اعتماد</span>
        </a>
    </li>
    @endpermission
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.subscription.plans')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/medal.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/medal-w.svg')}}" alt="">
            <span>خرید اشتراک</span>
        </a>
    </li>
    <hr/>
    <li class="panel-nav-ul-li-sub">
        <div class="panel-nav-ul-li-sub-menu">
            <span>آگهی های من</span>
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/down.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/down-white.svg')}}" alt="">
        </div>
        <ul class="panel-nav-ul-li-sub-ul">
            <li>
                <a href="{{route('request.estateForm')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/add.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/add-w.svg')}}" alt="">
                    <span>ثبت ملک</span>
                </a>
            </li>
            <li>
                <a href="{{route('panel.estateRequest.myEstateRequest')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/my-ad.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/my-ad-w.svg')}}" alt="">
                    <span>لیست ثبت ملک های من</span>
                </a>
            </li>
            @permission('confirmed-estate-request-list')
            <li>
                <a href="{{route('panel.estateRequest.confirmedEstateRequestList')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/ok-ad.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/ok-ad-w.svg')}}" alt="">
                    <span>لیست ثبت ملک های تایید شده</span>
                </a>
            </li>
            @endpermission
            @permission('unconfirmed-estate-request-list')
            <li>
                <a href="{{route('panel.estateRequest.unconfirmedEstateRequestList')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/nok-ad.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/nok-ad-w.svg')}}" alt="">
                    <span>لیست ثبت ملک های تایید نشده</span>
                </a>
            </li>
            <hr>
            @endpermission
        </ul>
    </li>
    <li class="panel-nav-ul-li-sub">
        <div class="panel-nav-ul-li-sub-menu">
            <span>درخواست های من</span>
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/down.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/down-white.svg')}}" alt="">
        </div>
        <ul class="panel-nav-ul-li-sub-ul">
            <li>
                <a href="{{route('request.requestForm')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/request.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/request-w.svg')}}" alt="">
                    <span>ثبت درخواست</span>
                </a>
            </li>
            <li>
                <a href="{{route('panel.request.myRequest')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/my-request.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/my-request-w.svg')}}" alt="">
                    <span>لیست درخواست های من</span>
                </a>
            </li>
            @permission('confirmed-request-list')
            <li>
                <a href="{{route('panel.request.confirmedRequestList')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/ok-ad.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/ok-ad-w.svg')}}" alt="">
                    <span>لیست درخواست های تایید شده</span>
                </a>
            </li>
            @endpermission
            @permission('unconfirmed-request-list')
            <li>
                <a href="{{route('panel.request.unconfirmedRequestList')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/nok-ad.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/nok-ad-w.svg')}}" alt="">
                    <span>لیست درخواست های تایید نشده</span>
                </a>
            </li>
            @endpermission
            @permission('user-requests-list')
            <li class="panel-nav-ul-li">
                <a href="{{route('panel.request.userRequests')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/my-request.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/my-request-w.svg')}}" alt="">
                    <span>لیست درخواست های کاربران</span>
                </a>
            </li>
            @endpermission
        </ul>
    </li>
    @permission('zoonkan')
    <li class="panel-nav-ul-li-sub-ul">
        <a href="{{route('panel.zoonkan.createZoonkanForm')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/zoonkan.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/zoonkan-w.svg')}}" alt="">
            <span>زونکن</span>
        </a>
        <hr>
    </li>
    @endpermission
    @permission('phonebook')
    <li class="panel-nav-ul-li-sub-ul">
        <a href="{{route('panel.contact.contactList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8_phone_contact.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/contact-w.svg')}}" alt="">
            <span>دفترچه تلفن</span>
        </a>
    </li>
    <hr>
    @endpermission
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.invoice.invoicesList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/invoice.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/invoice-w.svg')}}" alt="">
            <span>لیست تراکنش ها</span>
        </a>
    </li>
    <hr>
    @permission('cession-list')
    <li class="panel-nav-ul-li">
        <a href="{{route('panel.cession.reportsList')}}">
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/error.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/error-w.svg')}}" alt="">
            <span>لیست گزارشات واگذاری</span>
        </a>
    </li>
    <hr>
    @endpermission
    @role('admin')
    <li class="panel-nav-ul-li-sub">
        <div class="panel-nav-ul-li-sub-menu">
            <span>تنظیمات سایت</span>
            <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/down.svg')}}" alt="">
            <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/down-white.svg')}}" alt="">
        </div>
        <ul class="panel-nav-ul-li-sub-ul">
            <li>
                <a href="{{route('panel.area.addAreaForm')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/add-area.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/add-area-w.svg')}}" alt="">
                    <span>افزودن منطقه</span>
                </a>
            </li>
            <li>
                <a href="{{route('panel.area.areaList')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/sub.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/sub-w.svg')}}" alt="">
                    <span>لیست مناطق</span>
                </a>
            </li>
            <hr>
            <li>
                <a href="{{route('panel.city.addCityForm')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/icons8_Thracian_Map_2.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/city-w.svg')}}" alt="">
                    <span>افزودن شهر</span>
                </a>
            </li>
            <li>
                <a href="{{route('panel.city.cityList')}}">
                    <img class="panel-nav-img-gry" src="{{asset('icon/PanelAdmin/sub.svg')}}" alt="">
                    <img class="panel-nav-img-white" src="{{asset('icon/PanelAdmin/sub-w.svg')}}" alt="">
                    <span>لیست شهرها</span>
                </a>
            </li>
        </ul>
    </li>
    <hr>
    @endrole
    <li class="panel-nav-ul-li">
        <form method="post" action="{{route('logout')}}">
            @csrf
            <button>خروج</button>
        </form>
    </li>
</ul>
