<x-app-layout>
    
    @slot('title')
        {{ __('Produk Tambahan') }}
    @endslot
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar pb-3 pt-8">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Produk Tambahan</h1>
                            <!--end::Title-->

                             <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary"><span class="menu-icon"><i class="fa-solid fa-home fs-7"></i></span></a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        Produk Tambahan 
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
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <x-auth-session-status :status="session('status')" />

                    <x-data-table-card additionalButtons="custom_add">

                        @slot('customAddButton')
                            <!--begin::Filter Produk Main-->
                            <div class="w-250px me-2">
                                <form method="GET" action="{{ route('product-additional.index') }}" id="filterForm">
                                    <select name="prod" id="produkFilter" class="form-select form-select-solid"
                                        data-control="select2" data-hide-search="true" data-placeholder="Produk Main">
                                        <option value="">Pilih PIC</option>
                                        @foreach ($prod as $p)
                                            <option value="{{ $p->id }}" {{ request('prod') == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <!--end::Filter Produk Main-->

                            <div class="me-0">
                                <a href="{{ route('product-additional.create') }}" class="btn btn-primary" id="add-row">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    {{ __('common.btn_add') }}
                                </a>
                            </div>

                            
                        @endslot

                        
                        {{-- @slot('exportOptions')
                            @include('admin.laporan._export')
                        @endslot --}}

                        {{-- @slot('formCreate')
                            @include('admin.product._form-create')
                        @endslot --}}

                        @slot('data')
                            <h3 class="d-none d-lg-block text-black fs-3 fw-bolder text-center mb-7"> 
                                {{__('common.table-product-add')}}
                            </h3> 
                            @include('admin.product-additional._data-table')
                        @endslot
                    </x-data-table-card>
                </div>
                <!--end::Content container-->

            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        <!--begin::Footer-->
        @include('layouts._footer')
    </div>


    <!--end:::Main-->
    @push('js')
        <!--begin::Vendors Javascript-->
        <script src="{{ url('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        
        <!--begin::Cust Javascript-->
        <script src="{{ url('pages/js/additional_product/data-table.js') }}"></script>
        <!--end::Cust Javascript-->

        <script>
            $(document).ready(function () {
                $('#produkFilter').on('change', function () {
                    $('#filterForm').submit();
                });
            });
        </script>
    @endpush
</x-app-layout>

