<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->

    <section class="bg-light">
        <div class="app-container container-xxl position-relative d-flex align-items-center flex-wrap pt-lg-18">
            {{-- <section class="mt-5"> --}}
            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-muted">{{ __('Pemesanan Detail') }}</li>
            </ol>
            <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
            {{-- </section> --}}

        </div>
    </section>

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl app-container container-xxl pt-10 mb-5 mb-lg-10">


        <!--begin::Order summary-->
        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-5">
            <!--begin::Order details-->
            <div class="card card-flush py-4 flex-row-fluid shadow-sm">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Nomer Pemesanan (#{{ $orderfind->trx_code}})</h2>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-delivery-3 fs-2 me-2"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>Status Pesanan
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end text-uppercase">
                                        {!! \App\Enums\OrderStatusEnum::badge($orderfind->status) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-calendar fs-2 me-2"><span
                                                    class="path1"></span><span class="path2"></span></i> Tanggal Dibuat
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{  App\Helpers\Helper::dateFormat($orderfind->created_at, 'd F Y') }}
                                    </td>
                                    
                                </tr>
                                
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-wallet fs-2 me-2"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span></i> Metode Pemesanan
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        Online
                                        {{-- <img src="/template/assets/media/svg/card-logos/002-girl.svg" class="w-50px ms-2"/> --}}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Order details-->


            <!--end::Info Pengiriman-->
            <div class="card card-flush py-4 flex-row-fluid shadow-sm">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Info Pengiriman</h2>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-truck fs-2 me-2"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>Opsi Pegiriman
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end text-uppercase">
                                        @if($orderfind->shipping)
                                            <span class="badge badge-success">Menggunakan Pengiriman</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Menggunakan Pengiriman</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-cube-3 fs-2 me-2">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>Berat Barang
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        @if($orderfind->shipping)
                                            {{$orderfind->shipping->weight_kg}}Kg, {{$orderfind->shipping->volume_m3}}M3
                                        @else
                                            -
                                        @endif
                                    </td>
                                    
                                </tr>
                                
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-geolocation fs-2 me-2"><span class="path1"></span>
                                                <span class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span>
                                            </i> Tujuan Pengiriman
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        @if($orderfind->shipping)
                                            {{$orderfind->shipping->address_destination}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Info Pengiriman-->
            
            
        </div>
        <!--end::Order summary-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                <!--begin::Orders-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    

                    <!--begin::Product List-->
                    <div class="card shadow-sm card-flush py-4 flex-row-fluid overflow-hidden">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Daftar Pemesanan Product</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-575px">Product</th>
                                            <th class="min-w-70px text-end">Jumlah Item</th>
                                            <th class="min-w-100px text-end">Harga Satuan</th>
                                            <th class="min-w-100px text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($orderfind->items as $item)
                                            @php
                                                $harga = 0;
                                                if ($item->product) {
                                                    $harga = $productMainSpecification->harga;
                                                } elseif ($item->productadd) {
                                                    $harga = $item->productadd->harga_produk_tambahan;
                                                }

                                                $subtotal = $harga * ($item->quantity ?? 0);
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <div class="symbol symbol-50px">
                                                            @if ($item->productadd && $item->productadd != null)
                                                                <img src="{{ $item->productadd->getFirstMediaUrl('additional-product-thumbnail') }}" class=" symbol-label w-30px h-30px rounded-2 me-3" alt="product-grinviro">
                                                            @elseif ($item->product)
                                                                <img src="{{ $item->product->getFirstMediaUrl('product-thumbnail') }}" class=" symbol-label w-30px h-30px rounded-2 me-3" alt="product-grinviro">
                                                            @else
                                                                <img src="{{ url('/template/assets/media/product/no-image.jpg') }}" class=" symbol-label w-30px h-30px rounded-2 me-3" alt="product-grinviro">
                                                            @endif
                                                        </div>
                                                        <!--end::Thumbnail-->

                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            @if ($item->productadd)
                                                                <div class="fw-bold text-gray-900">{{ $item->productadd->nama_produk_tambahan }}</div> 
                                                            @else
                                                                <div class="fw-bold text-gray-900">{{ $item->product->nama_produk }} - {{ $productMainSpecification->type_name}}</div> 
                                                            @endif
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                
                                                <td class="text-end">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="text-end">
                                                    @if ($item->productadd)
                                                        -
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if ($item->productadd)
                                                        -
                                                    @else
                                                        -
                                                    @endif
                                                   
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <td colspan="3" class="fs-6 text-gray-900 text-end">
                                                
                                                <span class="text-gray-900 fw-bold d-block fs-5">Perkiraan Biaya Pengiriman</span>
                                                @if($orderfind->shipping)
                                                    @if($orderfind->shipping->shipping_cost == 0)
                                                        <span class="badge badge-danger text-muted fs-7">(Masih dalam Proses Konfirmasi)</span>
                                                    @else
                                                        <span class="text-muted fs-7">(Harga Sudah diEstimasi)</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-gray-900 fs-6 fw-bolder text-end">
                                                @if($orderfind->shipping)
                                                    -
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="fs-3 text-gray-900 text-end">
                                                Total Harga
                                            </td>
                                            <td class="text-gray-900 fs-3 fw-bolder text-end">
                                                -
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Product List-->
                </div>
                <!--end::Orders-->
            </div>
            <!--end::Tab pane-->

            
        </div>
        <!--end::Tab content-->

        <div class="d-flex flex-column border flex-xl-row gap-7 gap-lg-10 mb-5 mt-5">
            <div class="card card-flush py-4  flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Butuh Bantuan</h2>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Shipping address-->
                        <div class="card card-flush py-4 flex-row-fluid position-relative">
                            <!--begin::Background-->
                            <div
                                class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                <i class="ki-solid ki-delivery" style="font-size: 11em">
                                </i>
                            </div>
                            <!--end::Background-->

                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h5>sales@gunahijauinovasi.com</h5>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                +6282348114479<br/>
                                Ciputra World Office Surabaya<br/> Lt.29, Jl. Mayjen Sungkono,<br/>Surabaya
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Shipping address-->
                    </div>
                    <!--end::Card body-->
            </div>
        </div>
    </div>
    <!--end::Order details page-->
    <!--end::Content container-->
    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
</x-guest-layout>
