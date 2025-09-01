<x-auth-layout>
    @slot('title')
    {{ __('Dashboard') }}
    @endslot
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            {{-- <x-app-toolbar :title="__('menu.Master Produk')"></x-app-toolbar>--}}
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar pb-3 pt-8">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    
                                Halo {{ Auth()->user()->name }}
                            </h1>
                            <!--end::Title-->

                             <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        Dashboards
                                    </li>
                                    <!--end::Item-->          
                                </ul>
                                <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxxl">

                    @if (Auth::user()->role === 'admin')
                        @include('admin._dashboard')
                    @elseif (Auth::user()->role === 'pic')
                        @include('pic._dashboard')
                    @endif


                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        
    </div>
    <!--end:::Main-->
    

    @push('js')
    {{-- <script src="{{ url('pages/js/dashboard/dashboard.js') }}"></script> --}}
    {{-- <script src="/demo1/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script> --}}
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    @endpush
</x-auth-layout>