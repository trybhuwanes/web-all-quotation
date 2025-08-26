<x-app-layout>
    
    @slot('title')
        {{ __('Kategori Produk') }}
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
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Daftar Pesanan</h1>
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
                                        Daftar pesanan
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

                    <x-data-table-card additionalButtons="custom_add,export">

                        
                    @slot('customAddButton')
                        <!--begin::Filter PIC-->
                        <div class="w-150px me-2">
                            <form method="GET" action="{{ route('order-admin.index') }}" id="filterForm">
                                <select name="pic_id" id="picFilter" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true" data-placeholder="Filter PIC">
                                    <option value="">Pilih PIC</option>
                                    @foreach ($pics as $pic)
                                        <option value="{{ $pic->id }}" {{ request('pic_id') == $pic->id ? 'selected' : '' }}>
                                            {{ $pic->name }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <!--end::Filter PIC-->

                        <!--begin::Filter Status-->
                        <div class="w-150px">
                            <select name="status" id="statusFilter" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true" data-placeholder="Filter Status">
                                
                                <option value="">Semua Status</option>
                                
                                @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}" 
                                        {{ request('status') === $status->value ? 'selected' : '' }}>
                                        {{ ucfirst($status->value) }}
                                    </option>
                                @endforeach
                                
                            </select>
                        </div>
                        </form>
                        <!--end::Filter Status-->
                    @endSlot


                        
                        @slot('exportOptions')
                            @include('admin.order-admin._export')
                        @endslot

                        @slot('formCreate')
                            @include('admin.order-admin._form-detemine-pic')
                            @include('admin.order-admin._form-chage-order')
                        @endslot


                        @slot('data')
                            @include('admin.order-admin._data-table')
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
        <script src="{{ url('pages/js/manage_order/data-table.js') }}"></script>
        <script src="{{ url('pages/js/manage_order/mo.js') }}"></script>
        <script src="{{ url('pages/js/manage_order/determine-pic.js') }}"></script>
        <!--end::Cust Javascript-->

        <script>
            $(document).ready(function () {
                $('#picFilter').on('change', function () {
                    $('#filterForm').submit();
                });

                $('#statusFilter').on('change', function () {
                    $('#filterForm').submit();
                });
            });
        </script>
    @endpush
</x-app-layout>

