<div class="mb-0" id="home">
    @if(!request()->routeIs('wwtp.index'))
    
    <!--begin::Wrapper-->
    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom bg-hero"
        style="background-color:#EAFEFA;">
        
        <!--begin::Header-->
        <div class="landing-header position-fixed scroll" data-kt-sticky="true" data-kt-sticky-name="landing-header"
            data-kt-sticky-offset="{default: '70px', lg: '70px'}">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-equal">
                        <!--begin::Mobile menu toggle-->
                        <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                            id="kt_landing_menu_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-2hx">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Mobile menu toggle-->
                        <!--begin::Logo image-->
                        <a href="">
                            <img alt="Logo" src="{{ asset('assets/media/logos/Logo-Grinviro-Group-Baru-kecil.png') }}"
                                class="logo-default h-25px h-lg-30px" />
                            <img alt="Logo" src="{{ asset('assets/media/logos/Logo-Grinviro-Group-Baru-kecil.png') }}"
                                class="logo-sticky h-20px h-lg-25px" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo-->

                    @if(!request()->routeIs('wwtp.index'))
                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                            data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                            data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-regular"
                                id="kt_landing_menu">
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link  nav-link py-3 px-4 px-xxl-6" href="#kt_body"
                                        data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Beranda</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#feature"
                                        data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Fitur</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#price"
                                        data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Harga</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#contact"
                                        data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Hubungi Kami</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                    @endif


                    <!--begin::Toolbar-->
                    <div class="flex-equal text-end ms-1">
                        <a href="{{route('wwtp.index')}}" class="btn btn-success btn-demo" data-kt-scroll-toggle="true"
                            data-kt-drawer-dismiss="true">WWTP Calculate</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Landing hero-->
        @if(!request()->routeIs('wwtp.index'))
        <div class="container hero-content w-100">
            <div class="w-100">
                <p class="fw-bolder">Solusi Kasir Digital yang <span class="text-success">Dinamis</span> dan <span
                        class="text-success">Terjangkau</span></p>
                <a href="#content-1" class="btn btn-success mt-3" data-kt-scroll-toggle="true"
                    data-kt-drawer-dismiss="true">Pelajari Selengkapnya <i
                        class="fa-duotone fa-arrow-up-right-from-square"></i></a>
            </div>
            <div class="w-100">
                <img src="{{ asset('assets/media/own/asset1.png') }}" alt="" class="img-fluid w-auto">
            </div>
        </div>
        @endif
    </div>
    @endif
    <!--end::Wrapper-->
    @if(!request()->routeIs('wwtp.index'))
    <!--begin::Curve bottom-->
    <div class="landing-curve mb-10 mb-lg-20">
        <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                fill="#EAFEFA"></path>
        </svg>
    </div>
    @endif
    <!--end::Curve bottom-->
</div>