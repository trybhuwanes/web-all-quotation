<!--begin::User menu-->
<div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end">
        {{-- <img src="{{ url('template/assets/media/avatars/300-3.jpg') }}" alt="user" /> --}}
        <div class="symbol-label fs-3 bg-light-info text-info">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-2">
            <div class="menu-content d-flex align-items-center px-2">
                <!--begin::Avatar-->
                <div class="symbol-label symbol-50px me-5 fs-3 text-info">
                    {{-- <img alt="Logo" src="{{ url('template/assets/media/avatars/300-3.jpg') }}" /> --}}
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <!--end::Avatar-->
                
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-6">
                        {{ Auth()->user()->name }}
                    </div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-8">
                        {{ Auth()->user()->email }}
                    </a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->

        @if (Auth::user()->role === 'admin')
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="{{ route('user-pic.create') }}" class="menu-link px-5">{{__('Tambah PIC')}}</a>
        </div>
        <!--end::Menu item-->
        @endif

        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="javascript:void" class="menu-link px-5" onclick="$('#logout-form').submit();">
                Logout
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
<!--end::User menu-->
