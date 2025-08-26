<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->



    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <section class="mt-5">
            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-muted">{{ __('Product') }}</li>
            </ol>
            <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
        </section>

        <section class="mt-3">
            <div class="d-flex flex-column flex-lg-row py-5 py-lg-15 mb-lg-10 mb-20" id="kt_app_demos">
            {{-- Sidebar --}}
            <div class="app-sidebar-nav d-none d-lg-flex flex-column flex-lg-row-auto w-100 p-4 py-lg-0 ps-lg-2 pe-lg-12 min-h-lg-700px w-250px"
                id="kt_app_demos_sidebar_nav" data-kt-drawer="true" data-kt-drawer-name="app-demos-sidebar"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="auto" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_app_demos_sidebar_toggle" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">

                <!--begin::Sticky aside-->
                <div class="mb-0" id="kt_app_demos_sidebar_sticky_wrapper" data-kt-sticky="true"
                    data-kt-sticky-name="demos-sidebar-sticky" data-kt-sticky-offset=""
                    data-kt-sticky-release="#kt_app_stats" data-kt-sticky-width="210px" data-kt-sticky-left="auto"
                    data-kt-sticky-top="20px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95"
                    data-kt-sticky-released="true">

                    <div m-3>

                    
                    <!--begin::Title-->
                    <h4 class="mb-3">{{ __('Filter Kategori') }}</h4>
                    <!--end::Title-->

                    <!--begin::Search-->
                    {{-- <input type="text" id="searchBox" class="form-control mb-3" placeholder="Search..."> --}}
                    <!--end::Search-->
                    <form method="get">

                        <!--begin::Nav-->
                        <ul class="nav flex-column border-0">
                            <form id="filter-form" method="GET" action="{{ route('product-overview.index') }}">
                            @foreach ($scopes as $category)
                            <!--begin::Nav item-->
                            <li class="nav-item me-0">
                                <!--begin::Nav link-->
                                <label class="nav-link">
                                    {{-- <input type="checkbox" class="form-check-input" value=""> --}}
                                    <input type="checkbox" name="filter_scope[]" value="{{ $category->id }}" onchange="this.form.submit()"
                                    {{ is_array(request()->filter_scope) && in_array($category->id, request()->filter_scope) ? 'checked' : '' }}>
                                    <!--begin::Nav logo-->
                                    <span class="nav-link-logo m-0">
                                        <img class="nav-link-logo-img-active w-25px" src="{{ $category->logo }}" alt="">
                                    </span>
                                    <!--end::Nav logo-->
                                    <span class="nav-link-title">{{ $category->nama_kategori }}</span>
                                </label>
                                <!--end::Nav link-->
                            </li>
                            <!--end::Nav item-->
                            @endforeach
                            </form>

                        </ul>
                        <!--end::Nav-->
                    </form>

                    </div>


                    <!--end::Nav-->
                </div>
                <!--end::Sticky aside-->
            </div>
            {{-- End Sidebar --}}


            {{-- CONTENCT --}}
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-12">
                <!--begin::Demos toggle-->
                <button
                    class="btn btn-flex btn-light btn-active-color-primary btn-sm fw-bold d-lg-none ms-n2 me-2 mb-5"
                    id="kt_app_demos_sidebar_toggle">
                    <i class="ki-duotone ki-filter fs-2 me-2 ms-n2"><span class="path1"></span><span
                            class="path2"></span><span class="path3"></span><span
                            class="path4"></span></i>{{ __('Filter Kategori') }}
                </button>
                <!--end::Demos toggle-->

                <!--begin::Content-->
                <div class="tab-content" id="kt_app_demos_tab_content">

                    <!--begin::Tab pane-->
                    <div class="tab-pane fade active show" id="html-demos" role="tabpanel">

                        <!--begin::Heading holder-->
                        <div class="d-flex flex-stack flex-wrap gap-4 mb-10 demos-header" data-kt-sticky="true"
                            data-kt-sticky-name="html-demos-header-sticky"
                            data-kt-sticky-offset="{default: false, xl: '600px'}"
                            data-kt-sticky-release="#kt_app_stats"
                            data-kt-sticky-width="{target: '#kt_app_demos_tab_content'}" data-kt-sticky-left="auto"
                            data-kt-sticky-top="0" data-kt-sticky-animation="false" data-kt-sticky-zindex="96"
                            style="" data-kt-sticky-released="true">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bold fs-1 mb-1 letter-spacing">{{ __('Semua Product') }}</h1>
                                <!--end::Title-->

                                <!--begin::Description-->
                                <span class="text-gray-600 fw-semibold fs-5 letter-spacing">
                                    @if ($products->count() > 0)
                                        <p>{{ $products->count() }} {{ __('Product Ditemukan') }}</p>
                                    @else
                                        <p>{{ __('Tidak Ada Product Tersedia') }}</p>
                                    @endif
                                </span>
                                <!--end::Description-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Heading toolbar-->
                            <div class="d-flex align-items-center gap-4">
                                <!--begin::Grid modes-->
                                <div class="d-flex align-items-center gap-1">
                                    <a href="{{ route('product-overview.index') }}"
                                        class="btn btn-icon btn-flex btn-color-gray-600 btn-active-light btn-active-color-gray-900 w-40px h-40px active"
                                        data-kt-demos-grid-toggle="true" data-kt-demos-grid-mode="2"
                                        data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        data-bs-custom-class="tooltip-inverse" aria-label="2 columns view"
                                        data-bs-original-title="2 columns view" data-kt-initialized="1">
                                        <i class="ki-duotone ki-arrow-circle-right fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </div>
                                <!--end::Grid modes-->

                                <!--begin::Filter-->
                                <div class="demos-filter d-flex align-items-center">
                                    <form class="w-100 position-relative" autocomplete="off" data-gtm-form-interact-id="0" action="{{ route('product-overview.index') }}" method="GET">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        <!--end::Icon-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid px-13" onkeypress="if (event.keyCode == 13) {this.form.submit();}"
                                            name="q" value="{{ old('q', $query) }}" placeholder="Cari product..." data-gtm-form-interact-field-id="0">
                                        <!--end::Input-->
                                    </form>
                                    

                                    <a href="#"
                                        class="btn btn-flex btn-warning text-gray-800 fw-bold ms-4 d-none"
                                        data-bs-toggle="modal" data-bs-target="#kt_engage_sitemap_modal">
                                        {{ __('Page Sitemap') }}
                                    </a>
                                </div>
                                <!--end::Filter-->
                            </div>
                            <!--end::Heading toolbar-->
                        </div>
                        <!--end::Heading holder-->

                        <!--begin::Row-->
                        <div class="row g-10">
                            

                            @if ($products->isEmpty())
                                <div class="alert alert-danger text-center">
                                    Tidak ada produk yang ditemukan.
                                </div>
                            @else
                                @foreach ($products as $item)
                                <!--begin::Col-->
                                <div data-kt-grid-col="true" class="card col-md-2 col-md-4 shadow-sm hover-elevate card-rounded mb-3">
                                    <a class="d-block card-rounded" href="{{ route('product-overview.detail', $item->slug) }}">
                                        <div class="card-xl-stretch">
                                            <!--begin::Image-->
                                            @if ($item->getFirstMediaUrl('product-thumbnail') == null)
                                            <img alt="photo-product-grinviro" src="/template/assets/media/product/no-image.jpg" class="rounded-4 border border-4 border-gray-200 w-100">
                                            @else
                                            <img alt="photo-product-grinviro" src="{{ $item->getFirstMediaUrl('product-thumbnail') }}" class="rounded-4 border border-4 border-gray-200 w-100">
                                            @endif
                                            <!--end::Image-->
                                            <!--begin::Body-->
                                            <div class="my-3">
                                                <!--begin::Title-->
                                                <a href="{{ route('product-overview.detail', $item->slug) }}"
                                                    class="fs-3 text-gray-900 fw-bold text-hover-primary lh-base text-center d-block mb-3">
                                                    {{ $item->nama_produk}} 
                                                </a>
                                                <!--end::Title-->
                                                
                                                <!--begin::Text-->
                                                <div class="fs-7 text-center">
                                                    {{ substr($item->deskripsi_produk, 0, 70) }}...
                                                </div>
                                                <!--end::Text-->

                                                <!--begin::Text-->
                                                <div
                                                    class="fs-6 fw-bold mt-5 d-flex justify-content-between align-items-center">
                                                    
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Hot sales post-->
                                    </a>
                                </div>
                                <!--end::Col-->
                                @endforeach    
                            @endif


                            <div class="card-footer mt-2">
                                {{ $products->links('components.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>




                </div>
                <!--end::Content-->
            </div>
            {{-- CONTENCT --}}
            </div>
        </section>


        {{--  --}}

        
        {{--  --}}




    </div>
    <!--end::Content container-->

    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
</x-guest-layout>
