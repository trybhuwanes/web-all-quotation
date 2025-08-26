<!--begin::Notifications-->
<div class="app-navbar-item ms-2 ms-lg-6">
    <!--begin::Menu- wrapper-->
    <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="position: relative;">
        <i class="ki-outline ki-notification-on fs-1"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-danger w-15px h-15px ms-n4 mt-3"> 3</span>
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
        <!--begin::Heading-->
        <div class="d-flex flex-column bgi-no-repeat rounded-top">
            <!--begin::Title-->
            <h3 class="text-black fw-semibold px-9 mt-10 mb-6">Daftar Notifikasi
                <!-- <span class="fs-8 opacity-75 ps-3">24</span> -->
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab panel-->
            <!--begin::Items-->
            <div class="scroll-y mh-325px my-5 px-8">
                
            </div>
            <!--end::Items-->
            <!--begin::View more-->
            <div class="py-3 text-center border-top">
                {{-- <a href="{{ route('notifications.index') }}" class="btn btn-color-gray-600 btn-active-color-primary">Lihat Semua
                    <i class="ki-outline ki-arrow-right fs-5"></i></a> --}}
            </div>
            <!--end::View more-->

            <!--end::Tab panel-->
        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
</div>
<!--end::Notifications-->

@push('js')
<script>

</script>
@endpush