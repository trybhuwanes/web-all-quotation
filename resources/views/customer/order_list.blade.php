<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')

    <style>
        .text-bg-linear {
            background: linear-gradient(to right, #2e8232 0%, #ffd54c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <!--end::Header-->

    {{-- Banner Section --}}
    <section class="banner-wrapper">
        <img src="{{ asset('images/banner-order.webp') }}" 
            alt="Banner Pemesanan" 
            class="w-100 img-fluid" 
            style="max-height: 250px; object-fit: cover;">
    </section>

    <section class="bg-light">
        <div class="app-container container-xxl position-relative d-flex align-items-center flex-wrap pt-14">
            {{-- <section class="mt-5"> --}}
            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-muted">{{ __('Pemesanan') }}</li>
            </ol>
            <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
            {{-- </section> --}}

        </div>
    </section>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid mb-5 mb-lg-10">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl mb-5 mb-lg-10">
            <!--begin::Products-->
            <div class="card shadow-sm card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i><input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari orderan anda..">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
            
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Flatpickr-->
                        {{-- <div class="input-group w-250px">
                            <input class="form-control form-control-solid rounded rounded-end-0 flatpickr-input" placeholder="Pick date range" id="kt_ecommerce_sales_flatpickr" type="hidden"><input class="form-control form-control-solid rounded rounded-end-0 form-control input" placeholder="Pick date range" tabindex="0" type="text" readonly="readonly">
                            <button class="btn btn-icon btn-light" id="kt_ecommerce_sales_flatpickr_clear">
                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                </button>
                        </div> --}}
                        <!--end::Flatpickr-->
            
                        <!--begin::Select Status-->
                        <div class="d-flex align-items-center gap-2 w-100 mw-250px">
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                <option></option>
                                {{-- <option value="g">Semua</option> --}}
                                @foreach (\App\Enums\OrderStatusEnum::toArray() as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>

                            <!-- Tombol clear -->
                            <button type="button" id="clearStatusFilter" 
                                    class="btn btn-sm btn-light-danger btn-active-danger py-4" 
                                    style="display:none;">✖
                            </button>
                        </div>
                        <!--end::Select Status-->
                        
                        <!--begin::Add product-->
                        {{-- <a href="/metronic8/demo1/apps/ecommerce/catalog/add-product.html" class="btn btn-primary">
                            Kembali
                        </a> --}}
                        <!--end::Add product-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">

                    <div id="kt_ecommerce_sales_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                        <div id="" class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-5 dataTable" id="kt_ecommerce_sales_table" style="width: 100%;">
                                <thead>
                                    <tr class="text-center text-black fw-bold fs-7 text-uppercase gs-0" role="row">
                                        <th class="min-w-80px">Order ID</th>
                                        <th class="text-center min-w-100px">Pengiriman</th>
                                        <th class="text-center min-w-50px">Status</th>
                                        <th class="text-center min-w-100px">Total</th>
                                        <th class="text-center min-w-100px">Tanggal Dibuat</th>
                                        <th class="text-center min-w-100px">Tanggal Diperbarui</th>
                                        <th class="text-center min-w-100px">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($myorderall as $data)
                                        <tr>
                                            <td class="text-start dt-type-numeric"
                                                data-kt-ecommerce-order-filter="order_id">
                                                <a href="{{ route('order.detail', $data->uuid) }}" class="text-gray-800 text-hover-primary fw-bold">
                                                {{ $data->trx_code}}</a>
                                            </td>
                                            <td>                                                    
                                                <!--begin::Company Destination-->
                                                @if ($data->shipping->company_destination)
                                                    <span class="text-gray-800 fs-7 fw-bold">{{$data->shipping->company_destination}}
                                                        <p style="font-size: 11px">{{$data->shipping->country_destination}}, {{$data->shipping->state_destination}}</p>
                                                    </span>
                                                @else
                                                    <span class="text-gray-800 fs-7 fw-bold">{{$data->user->company}}
                                                        <p style="font-size: 11px">{{$data->shipping->country_destination}}, {{$data->shipping->state_destination}}</p>
                                                    </span>
                                                @endif
                                                    <!--end::Company Destination-->
                                            </td>
                                            <td class="text-center pe-0" data-order="Completed">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-success">{!! \App\Enums\OrderStatusEnum::badge($data->status) !!}</div>
                                                <!--end::Badges-->
                                            </td>
                                            <td class="text-end pe-0 dt-type-numeric">
                                                <span class="fw-bold">@idr($data->total_price)</span>
                                            </td>
                                            <td class="text-end dt-type-date" data-order="2024-09-23">
                                                <span class="fw-bold">{{  App\Helpers\Helper::dateFormat($data->created_at, 'd/m/Y') }}</span>
                                            </td>
                                            <td class="text-end dt-type-date" data-order="2024-09-26">
                                                <span class="fw-bold">{{  App\Helpers\Helper::dateFormat($data->updated_at, 'd/m/Y') }}</span>
                                            </td>
                                            <td class="text-end">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('order.detail', $data->uuid) }}"
                                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary menu-link px-3">
                                                        Detail Order
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <tfoot></tfoot> --}}
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->

            <div class="landing-dark-separator mt-10"></div>
            
            <!--begin::Frameworks-->
            <div class="d-flex flex-column mb-lg-10 mb-20 pt-10" id="kt_app_frameworks" >
                
                <!--begin::Heading-->
                <div class="d-flex flex-column flex-center mb-10 mb-lg-15">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fs-2hx fw-semibold letter-spacing">
                        Produk Lainnya
                    </h1>
                    <!--end::Title-->

                    <!--begin::Subtitle-->
                    <h3 class="d-flex text-gray-900 fs-2hx fw-bolder mb-10 letter-spacing">
                        <span class="ms-3 d-inline-flex position-relative">
                            <span class="px-1">Our</span>
                            <img class="w-100 position-absolute bottom-0 mb-n2" src="/metronic/assets/media/misc/frameworks-title-underline.svg" alt=""/>
                        </span>
                        <span class="text-bg-linear">
                            Tested Product
                        </span>
                    </h3>
                    <!--end::Subtitle-->

                    <!--begin::Description-->
                    <div class="text-gray-700 text-center fs-4 fw-semibold opacity-75">
                        Dapatkan Penawaran Produk Lainnya dari Kami!
                    </div>
                    <!--end::Description-->
                    
                </div>
                <!--end::Heading-->
                

                <!--begin::Row-->
                <div class="row g-10 justify-content-center">
                    @foreach ($products as $item)
                        <!--begin::Col-->
                        <div class="col-md-4 d-flex">
                            <div class="card shadow-sm card-hover flex-fill">
                                <div class="card-body p-8">
                                    <a class="d-block card-rounded bg-gray-100 border border-gray-200 overflow-hidden mb-6" target="_blank" href="{{ route('product-overview.detail', $item->slug) }}">
                                        <img class="w-100" src="{{ $item->getFirstMediaUrl('product-thumbnail') }}"/>
                                    </a>
                                    <div class="d-flex flex-column gap-2 p-2">
                                        <h3 class="fs-4 fw-bold text-gray-900">
                                            {{$item->nama_produk}}
                                        </h3>
                                        <div class="fs-6 fw-semibold text-gray-700">
                                            {{ substr($item->deskripsi_produk, 0, 70) }}
                                        </div>
                                        <a class="fs-6 fw-bold text-primary" target="_blank" href="{{ route('product-overview.detail', $item->slug) }}">
                                            {{__('Lihat')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                    @endforeach
                </div>
                <!--end::Row-->
            </div>
            <!--end::Frameworks-->


            

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
    @push('js')
    <!--begin::Vendors Javascript-->
    <script src="{{ url('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#kt_ecommerce_sales_table').DataTable({
                // "responsive": true,
                "processing": true,
                "serverSide": false,
                "searching": true,
                "paging": true,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "Cari:",
                    // "lengthMenu": "Tampilkan _MENU_ entri",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ Data",
                    "infoEmpty": "Tidak ada data tersedia",
                    "zeroRecords": "Tidak ditemukan data yang cocok",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                }
            });

            var $statusSelect = $('[data-kt-ecommerce-order-filter="status"]');
            var $clearBtn = $('#clearStatusFilter');

            $statusSelect.on('change', function() {
                var status = $(this).val();
                if (status) {
                    table.column(2).search(status, true, false).draw();
                    $clearBtn.show();
                } else {
                    table.column(2).search('').draw();
                    $clearBtn.hide();
                }
            });

            // Event tombol clear
            $clearBtn.on('click', function() {
                $statusSelect.val(null).trigger('change'); // reset select2
                table.column(2).search('').draw(); // reset filter
                $clearBtn.hide();
            });

            $('[data-kt-ecommerce-order-filter="search"]').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush

</x-guest-layout>
