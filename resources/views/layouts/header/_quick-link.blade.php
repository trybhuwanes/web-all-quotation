<!--begin::Quick links-->
<div class="app-navbar-item ms-1 ms-lg-3">
    <!--begin::Menu wrapper-->
    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
        data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
        <span class="svg-icon svg-icon-1">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                    fill="currentColor" />
                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                    fill="currentColor" />
                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
        <!--begin::Heading-->
        <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
            style="background-image:url('{{ url('template/assets/media/misc/menu-header-bg.jpg') }}')">
            <!--begin::Title-->
            <h3 class="text-white fw-semibold mb-3">
                {{-- {{ __('Modules') }} --}}
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
        <!--begin:Nav-->
        <div class="row g-0">
            <x-module-item></x-module-item>
        </div>
        <!--end:Nav-->
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
</div>
<!--end::Quick links-->
