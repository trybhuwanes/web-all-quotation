<!--begin::Container-->
<div class="container">
    <!--begin::Wrapper-->
    <div class="d-flex align-items-center justify-content-between">
        <!--begin::Logo-->
        <div class="d-flex align-items-center flex-equal">
            <!--begin::Mobile menu toggle-->
            <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">

                <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/text/txt001.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-2hx">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </button>
            <!--end::Mobile menu toggle-->

            <!--begin::Logo image-->
            <a href="">
                <img alt="Logo" src="{{ url('template/assets/media/logos/logo-ghi.webp') }}"
                    class="logo-default h-25px h-lg-30px" />
                <img alt="Logo" src="{{ url('template/assets/media/logos/logo-ghi.webp') }}"
                    class="logo-sticky h-20px h-lg-25px" />
            </a>
            <!--end::Logo image-->
        </div>
        <!--end::Logo-->

        <!--begin::Menu wrapper-->
        <div class="d-lg-block" id="kt_header_nav_wrapper">
            <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="app-header-menu"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">

                <!--begin::Menu-->
                <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-800 menu-state-title-primary nav nav-flush fs-4 fw-semibold"
                    id="kt_landing_menu">
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <!--begin::Menu link-->
                        <a class="menu-link nav-link py-3 px-4 px-xxl-6 @activeIs('home')" href="{{ route('home') }}"
                            data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('menu.Home') }}</a>
                        <!--end::Menu link-->
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <!--begin::Menu link-->
                        <a class="menu-link nav-link  py-3 px-4 px-xxl-6 @activeIs('product-overview.index')"
                            href="{{ route('product-overview.index') }}" data-kt-scroll-toggle="true"
                            data-kt-drawer-dismiss="true">{{ __('menu.Produk') }}</a>
                        <!--end::Menu link-->
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item with Submenu-->
                    <div class="menu-item menu-dropdown">
                        <a class="menu-link nav-link py-3 px-4 px-xxl-6 " href="#" id="menu-produk">
                            Tentang Kami
                            <span class="dropdown-arrow fs-4">&#9662;</span> <!-- Arrow icon -->
                        </a>
                        
                        <!--begin::Submenu-->
                        <div class="submenu d-none" id="submenu-produk">
                            <a class="submenu-link fs-4 py-2 px-4  @activeIs('about-us')" href="{{ route('about-us') }}">Profil Perusahaan</a>
                            <a class="submenu-link fs-4 py-2 px-4" href="https://grinviro-global.com/">Grinviro Global</a>
                        </div>
                        <!--end::Submenu-->
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <!--begin::Menu link-->
                        <a class="menu-link nav-link  py-3 px-4 px-xxl-6 @activeIs('contact-us')"
                            href="{{ route('contact-us') }}" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('menu.Hubungi Kami') }}</a>
                        <!--end::Menu link-->
                    </div>
                    <!--end::Menu item-->


                    


                </div>
                <!--end::Menu-->
            </div>
        </div>
        <!--end::Menu wrapper-->

        <!--begin::Toolbar-->
        <div class="flex-equal flex-equal-search text-end ms-1">
            <form action="{{ route('search.global') }}" method="GET" class="w-70 me-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control bg-light border-0" placeholder="Cari produk" aria-label="Search" required>
                    <button type="submit" class="input-group-text bg-light border-1">
                        <i class="ki-duotone ki-magnifier fs-3 text-muted"><span class="path1"></span><span class="path2"></span>
                        </i>
                    </button>
                </div>
            </form>            

            
            @if (auth()->check())
                <!-- jika sudah login -->
                {{-- <span class="fs-6 fw-semibold text-gray-500">{{ auth()->user()->name }}</span> --}}
                <div class="app-navbar-item ms-3 me-6" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px symbol-circle border"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <span class="symbol-label bg-primary text-inverse-primary fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        {{-- <img class="symbol symbol-35px" src="{{ url('template/assets/media/avatars/300-3.jpg') }}"  alt="pengguna"> --}}
                    </div>

                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true" style="">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-35px symbol-circle me-3">
                                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <!--end::Avatar-->

                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-6">{{ auth()->user()->name }}
                                        {{-- <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                            Pro
                                        </span> --}}
                                    </div>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->

                        {{-- <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="javascript:void" class="menu-link px-5">
                                {{ __('Profil Saya') }}
                            </a>
                        </div>
                        <!--end::Menu item--> --}}


                        @if (Auth::user()->role === 'admin')
                            <div class="menu-item px-5">
                                <a href="{{route('admin.dashboard')}}" class="menu-link px-5">
                                    {{ __('Dashboard') }}
                                </a>
                            </div>
                        @elseif (Auth::user()->role === 'pic')
                            <div class="menu-item px-5">
                                <a href="{{route('pic.dashboard')}}" class="menu-link px-5">
                                    {{ __('Dashboard') }}
                                </a>
                            </div>
                        @else
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{ route('myorder.all') }}" class="menu-link px-5">
                                    {{ __('Pesanan Saya') }}
                                </a>
                            </div>
                            <!--end::Menu item-->

                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{ route('cart.index') }}" class="menu-link px-5">
                                    <span class="menu-text">
                                        {{ __('Keranjang Saya') }}
                                    </span>
                                    <span class="menu-badge">
                                        <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle start-60 animation-blink">
                                        </span>
                                        {{-- <span class="badge badge-light-danger badge-circle fw-bold fs-7"></span> --}}
                                    </span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            
                        @endif

                        

                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->

                        {{-- <!--begin::Menu item-->
                        <div class="menu-item px-5 my-1">
                            <a href="javascript:void" class="menu-link px-5">
                                {{ __('Versi web') }}
                            </a>
                        </div>
                        <!--end::Menu item--> --}}

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="javascript:void" class="menu-link px-5" onclick="$('#logout-form').submit();">
                                {{ __('common.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->

                    <!--end::Menu wrapper-->
                </div>
            @else
                <!-- jika belum login -->
                <a href="{{ route('login') }}" class="btn btn-flex btn-outline btn-outline-default btn-active-color-primary btn-color-gray-500 h-35px py-0 fs-base rounded-3 px-4 fw-semibold">
                {{ __('common.sign_in') }}</a>
            @endif

        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Container-->
