{{-- Navbar ADMIN --}}
@if (Auth::user()->role === 'admin')
    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link"
            href="{{ route('admin.dashboard') }}" title="Lihat halaman Dashboard Admin">
            <span class="menu-icon"> 
                <i class="ki-duotone ki-element-11 fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Dashboard</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'alluser.index' ? 'active' : '' }}"
            href="{{ route('alluser.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-address-book fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            </span>
            <span class="menu-title"><b>Pengguna</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'targets.index' ? 'active' : '' }}"
            href="{{ route('targets.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-address-book fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            </span>
            <span class="menu-title"><b>Target PIC</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    

    <div data-kt-menu-trigger="click" class="menu-item menu-accordion fw-bold fs-6">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-cube-2 fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title">{{ __('menu.Produk') }}</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->

        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion menu-active-bg" kt-hidden-height="84"
            style="display: none; overflow: hidden;">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ $currentRouteName == 'kategori-product.index' ? 'active' : '' }}" href="{{ route('kategori-product.index') }}">
                    <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span></span><span class="menu-title">Kategori</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ $currentRouteName == 'product.index' ? 'active' : '' }}" href="{{ route('product.index') }}">
                    <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span></span><span class="menu-title">Produk</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>


    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'product-additional.index' ? 'active' : '' }}"
            href="{{ route('product-additional.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-cube-3 fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Produk Tambahan</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'order-admin.index' ? 'active' : '' }}"
            href="{{ route('order-admin.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-purchase fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Pesanan</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->


    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'versiapps.admin' ? 'active' : '' }}"
            href="{{ route('versiapps.admin') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-square-brackets fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Versi Web</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->


{{-- Navbar PIC --}}
@elseif (Auth::user()->role === 'pic')
    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'pic.dashboard' ? 'active' : '' }}"
            href="{{ route('pic.dashboard') }}" title="Lihat halaman Dashboard PIC">
            <span class="menu-icon"> 
                <i class="ki-duotone ki-abstract-28 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Dashboard</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'picproduct.index' ? 'active' : '' }}"
            href="{{ route('picproduct.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-cube-2 fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
            </span>
            <span class="menu-title"><b>Produk</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'picproduct-additional.index' ? 'active' : '' }}"
            href="{{ route('picproduct-additional.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-cube-3 fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Produk Tambahan</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ $currentRouteName == 'order-pic.index' ? 'active' : '' }}"
            href="{{ route('order-pic.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-purchase fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </span>
            <span class="menu-title"><b>Pesanan</b></span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu Item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        {{-- <a class="menu-link {{ $currentRouteName == 'versiapps.pic' ? 'active' : '' }}"
            href="{{ route('versiapps.pic') }}">
            <span class="menu-icon"> <i class="fa-solid fa-screwdriver-wrench fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <span class="menu-title"><b>Versi Web</b></span>
        </a> --}}
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
@endif
