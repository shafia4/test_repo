<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">
        <!--begin::Left-->
        <div class="d-flex align-items-stretch mr-3">
            <!--begin::Header Logo-->
            <div class="header-logo">
                <a href="index.html">
                    <img alt="Logo" src="{{ URL::to('assets/media/logos/logo-letter-9.png') }}" class="logo-default max-h-40px" />
                    <img alt="Logo" src="{{ URL::to('assets/media/logos/logo-letter-1.png') }}" class="logo-sticky max-h-40px" />
                </a>
            </div>
            <!--end::Header Logo-->
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                    <!--begin::Header Nav-->
                    <ul class="menu-nav">
                        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                            <a href="{{ env('APP_URL') }}" class="menu-link menu-toggle">
                                <span class="menu-text">Home</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar">
            @guest
            <div class="topbar-item">
                <a href="{{ route('login') }}" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Login</a>
            </div>

            <div class="topbar-item">
                <a href="{{ route('register') }}" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Register</a>
            </div>
            @else
            <div class="topbar-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>

            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto">
                        <span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">{{ auth()->user()->email }}</span>
                        <span class="symbol symbol-35">
                            <span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">{{ substr(auth()->user()->email, 0,1) }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center p-8 rounded-top">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                            <img src="{{ URL::to('assets/media/users/300_21.jpg') }}" alt="" />
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ auth()->user()->name }}</div>
                        <span class="label label-light-success label-lg font-weight-bold label-inline">3 messages</span>
                        <!--end::Text-->
                    </div>
                    <div class="separator separator-solid"></div>
                    <!--end::Header-->
                    <!--begin::Nav-->
                    <div class="navi navi-spacer-x-0 pt-5">
                        <!--begin::Item-->
                        <a href="custom/apps/user/profile-1/personal-information.html" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-calendar-3 text-success"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">My Profile</div>
                                    <div class="text-muted">Account settings and more
                                        <span class="label label-light-danger label-inline font-weight-bold">update</span></div>
                                </div>
                            </div>
                        </a>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <a href="custom/apps/user/profile-3.html" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-mail text-warning"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">My Messages</div>
                                    <div class="text-muted">Inbox and tasks</div>
                                </div>
                            </div>
                        </a>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <a href="custom/apps/user/profile-2.html" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-rocket-1 text-danger"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">My Activities</div>
                                    <div class="text-muted">Logs and notifications</div>
                                </div>
                            </div>
                        </a>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <a href="custom/apps/userprofile-1/overview.html" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-hourglass text-primary"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">My Tasks</div>
                                    <div class="text-muted">latest tasks and projects</div>
                                </div>
                            </div>
                        </a>
                        <!--end::Item-->
                        <!--begin::Footer-->
                        <div class="navi-separator mt-3"></div>
                        <div class="navi-footer px-8 py-5">
                            <a href="custom/user/login-v2.html" target="_blank" class="btn btn-light-primary font-weight-bold">Sign Out</a>
                            <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean font-weight-bold">Upgrade Plan</a>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            @endguest
            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm" src="{{ URL::to('assets/media/svg/flags/226-united-states.svg') }}" alt="" />
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ URL::to('assets/media/svg/flags/226-united-states.svg') }}" alt="" />
                                </span>
                                <span class="navi-text">English</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item active">
                            <a href="#" class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ URL::to('assets/media/svg/flags/128-spain.svg') }}" alt="" />
                                </span>
                                <span class="navi-text">Spanish</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ URL::to('assets/media/svg/flags/162-germany.svg') }}" alt="" />
                                </span>
                                <span class="navi-text">German</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ URL::to('assets/media/svg/flags/063-japan.svg') }}" alt="" />
                                </span>
                                <span class="navi-text">Japanese</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ URL::to('assets/media/svg/flags/195-france.svg') }}" alt="" />
                                </span>
                                <span class="navi-text">French</span>
                            </a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->

        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
