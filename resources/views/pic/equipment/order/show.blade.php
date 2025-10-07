<x-app-layout>
    @slot('title')
    {{ __('Detail Laporan Diskusi') }}
@endslot
<header>
    <style>
        .bg-primarylight {
            background-color: rgba(46, 130, 50);
        }
    </style>
</header>
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
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Detail Order {{ $orderdetail->trx_code}}
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
            <div id="kt_app_content_container" class="app-container  container-xxl">

                {{-- CONTEN --}}
                <!--begin::Layout-->
                <!--begin::Order summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-5">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid bg-primarylight">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="text-white">Nomor Pemesanan (#{{ $orderdetail->trx_code}})</h2>
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
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-delivery-3 fs-2 me-2 text-white"><span class="path1"></span><span
                                                            class="path2"></span><span class="path3"></span><span
                                                            class="path4"></span><span class="path5"></span></i>Status Pesanan
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-uppercase text-white">
                                                {!! \App\Enums\OrderStatusEnum::badge($orderdetail->status) !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-user-square fs-2 me-2 text-white">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        </i> PIC
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-white">
                                                {{ optional($orderdetail->pic)->name ?? '-' }}
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-calendar fs-2 me-2 text-white"><span
                                                            class="path1"></span><span class="path2"></span></i> Tanggal Dibuat
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-white">
                                                {{  App\Helpers\Helper::dateFormat($orderdetail->created_at, 'd F Y') }}
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-wallet fs-2 me-2 text-white"><span class="path1"></span><span
                                                            class="path2"></span><span class="path3"></span><span
                                                            class="path4"></span></i> Metode Pemesanan
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-white">
                                                Online
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

                    <!--begin::Customer details-->
                    <div class="card card-flush py-4  flex-row-fluid bg-primarylight">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="text-white">Pelanggan</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-white">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-profile-circle fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    Pelanggan
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin::Name-->
                                                    <span>
                                                        {{ $orderdetail->user->name}}
                                                    </span>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-sms fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>                                Email
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <a href="mailto:{{ $orderdetail->user->email }}" class="text-white text-hover-warning">
                                                    {{ $orderdetail->user->email}}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-phone fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>                                Phone
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $orderdetail->user->phone}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Customer details-->
                    
                </div>
                <!--end::Order summary-->

                {{-- PENGIRIMAN CONTENT --}}
                @include('form-modal._form-prince-delivery')
                @include('form-modal._form-weight-delivery')
                <!--Begin::Delivery details-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-5" id="kt_modal_delivery">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__('Info Pengiriman')}}</h2>
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
                                                @if($orderdetail->shipping)
                                                    <span class="badge badge-success">Menggunakan Pengiriman</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak Menggunakan Pengiriman</span>
                                                @endif
                                            </td>
                                        </tr>

                                        @if($orderdetail->shipping)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-cube-3 fs-2 me-2">
                                                            <span class="path1"></span><span class="path2"></span>
                                                        </i>Berat Barang
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    {{$orderdetail->shipping->weight_kg}} kg, {{$orderdetail->shipping->volume_m3}} m<sup>3</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-geolocation fs-2 me-2"><span class="path1"></span><span
                                                            class="path2"></span><span class="path3"></span><span
                                                            class="path4"></span></i> Tujuan Pengiriman
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    {{$orderdetail->shipping->company_destination}} <br>
                                                    {{$orderdetail->shipping->address_destination}}
                                                </td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>

                                    <tfoot>
                                        <div class="text-end" data-bs-placement="top" data-bs-trigger="hover">
                                            @if ($orderdetail->shipping)
                                            <a href="" class="btn btn-sm btn-info btn-active-primary edit-delivery" data-bs-toggle="modal" data-bs-target="#kt_modal_bidding"
                                                data-kt-shipping-id="{{ $orderdetail->shipping->id }}"
                                                data-kt-shipping-p="{{ $orderdetail->shipping->shipping_cost }}">
                                                <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                {{__('Harga Pengiriman')}}
                                            </a>

                                            <a href="" class="btn btn-sm btn-info btn-active-primary edit-weight" data-bs-toggle="modal" data-bs-target="#kt_modal_weight"
                                                data-kt-shipping-id="{{ $orderdetail->shipping->id }}"
                                                data-kt-weight-p="{{ $orderdetail->shipping->weight_kg }}"
                                                data-kt-volume-p="{{ $orderdetail->shipping->volume_m3 }}">
                                                <i class="ki-duotone ki-cube-3 fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                {{__('Berat Barang')}}
                                            </a>
                                            @endif
                                        </div>
                                    </tfoot>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->
                </div>
                <!--end::Delivery details-->

                {{-- ATTACHMENT --}}
                <!--Begin::Attachment-->
                @include('form-modal._form-attachment')

                <div class="tab-content mb-5" id="kt_modal_attachment_order">
                    <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">{{__('Attachment File')}}</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Masukkan 1 file berekstensi .pdf maksimal berukuran 2 Mb</span>
                        </h3>

                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Klik untuk upload file attachment">
                            <a href="" class="btn btn-sm btn-light btn-active-primary attachment" data-bs-toggle="modal" data-bs-target="#kt_modal_attachment"
                                data-kt-attachment-id="{{ $orderdetail->id }}">
                                <i class="ki-duotone ki-file-up fs-2"><span class="path1"></span><span class="path2"></span></i>{{__('Upload Doc')}}
                            </a>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        @if ($orderdetail->attachment_path)
                            <div class="text-end">
                                <button type="button" 
                                    class="mb-6 btn btn-sm btn-danger" 
                                    id="delete-attachment-btn"
                                    data-order-id="{{ $orderdetail->id }}">
                                    <i class="ki-duotone ki-trash fs-2"></i> Hapus File
                                </button>
                            </div>

                            {{-- {{ Storage::url($orderdetail->attachment_path) }} --}}
                            <iframe class="rounded mb-3" 
                                src="{{ Storage::url($orderdetail->attachment_path) }}" 
                                frameborder="0" width="100%" height="600px">
                            </iframe>
                        @endif
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->

                </div>
                <!--end::Attachment-->

                {{-- DAFTAR ORDER CONTENT --}}
                @include('form-modal._form-prince-discont')
                <!--begin::Product Order Tab content-->
                <div class="tab-content mb-5" id="kt_modal_discount">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            
                            <!--begin::Product List-->
                            <div class="card shadow-sm card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Product yang Dipesan</h2>
                                    </div>

                                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Klik untuk memberi diskon">
                                        {{-- <a href="" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_discount"> 
                                            <i class="ki-duotone ki-discount fs-2"></i>{{__('Diskon')}}
                                        </a> --}}

                                        <a href="" class="btn btn-sm btn-info btn-active-primary edit-discount" data-bs-toggle="modal" data-bs-target="#kt_modal_discount"
                                            data-kt-o-id="{{ $orderdetail->id }}"
                                            data-kt-discount-p="{{ $orderdetail->discount_amount }}">
                                            <i class="ki-duotone ki-discount fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            {{__('Diskon')}}
                                        </a>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead style="background-color: white;">
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-575px">Product</th>
                                                    <th class="min-w-70px text-center">Jumlah Item</th>
                                                    <th class="min-w-100px text-end">Harga Satuan</th>
                                                    <th class="min-w-100px text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach ($orderdetail->items as $item)
                                                    @php
                                                        // Initialize variables
                                                        $harga = 0;
                                                        if ($item->product) {
                                                            $harga = $productMainSpecification->harga;
                                                        } elseif ($item->productadd) {
                                                            $harga = $item->custom_price ?? $item->productadd->harga_produk_tambahan;
                                                        }
        
                                                        // Calculate subtotal
                                                        $subtotal = $harga * ($item->quantity ?? 0);
                                                        // $grandTotal += $subtotal;
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
                                                        
                                                        <td class="text-center">
                                                            {{ $item->quantity }}
                                                        </td>
                                                        <td class="text-end">
                                                            @if ($item->productadd)
                                                                <div class="d-flex justify-content-end align-items-center">
                                                                    <div class="fw-bold text-gray-800 me-2">
                                                                       @idr($item->custom_price ?? $item->productadd->harga_produk_tambahan)
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="fw-bold text-gray-800">@idr($productMainSpecification->harga)</div>
                                                            @endif
                                                        </td>
                                                        <td class="text-end">
                                                            @idr($subtotal)
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                                {{-- SubTotal --}}
                                                <tr>
                                                    <td colspan="3" class="fs-6 text-gray-900 text-end">
                                                        <span class="text-gray-900 fw-bold d-block fs-5">Sub Total</span>
                                                    </td>
                                                    <td class="fs-6 text-end">
                                                        @if (!$orderdetail->subtotal)
                                                            @idr($orderdetail->total_price + $orderdetail->discount_amount - $orderdetail->shipping->shipping_cost)
                                                        @else
                                                            @idr($orderdetail->subtotal)
                                                        @endif
                                                    </td>
                                                </tr>
                                                
                                                {{-- Biaya pengiriman --}}
                                                <tr>
                                                    <td colspan="3" class="fs-6 text-gray-900 text-end">
                                                        <span class="text-gray-900 fw-bold d-block fs-5">Perkiraan Biaya Pengiriman</span>
                                                        {{-- <span class="text-muted fs-7">(Masih dalam Proses Konfirmasi)</span> --}}
                                                    </td>
                                                    <td class="fs-6 text-end">
                                                        @if($orderdetail->shipping->shipping_cost)
                                                            @idr($orderdetail->shipping->shipping_cost)
                                                        @else
                                                            Belum diinput
                                                        @endif
                                                    </td>
                                                </tr>
                                                
                                                {{-- begin::Diskon --}}
                                                <tr>
                                                    <td colspan="3" class="fs-6 text-gray-900 text-end">
                                                        <span class="text-gray-900 fw-bold d-block fs-5">Diskon</span>
                                                        <span class="text-muted fs-7"></span>
                                                    </td>
                                                    <td class="fs-6 text-end">
                                                        @if ($orderdetail->discount_type === 'fixed')
                                                            -@idr($orderdetail->discount_amount)
                                                        @else
                                                            ({{(int)$orderdetail->discount_amount}}%) -@idr(($orderdetail->discount_amount)/100 * ($orderdetail->subtotal))
                                                        @endif
                                                    </td>
                                                </tr>
                                                {{-- end::Diskon --}}

                                                {{-- begin::Total Harga --}}
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-gray-900 text-end">
                                                        Total Harga
                                                    </td>
                                                    <td class="text-gray-900 fs-3 fw-bolder text-end">
                                                        @if ($orderdetail->subtotal)
                                                            @if ($orderdetail->shipping->shipping_cost)
                                                                @idr($orderdetail->total_price + $orderdetail->shipping->shipping_cost)
                                                            @else
                                                                @idr($orderdetail->total_price)
                                                            @endif
                                                        @else
                                                            @idr($orderdetail->total_price)
                                                        @endif
                                                    </td>
                                                </tr>
                                                {{-- end::Total Harga --}}
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
                <!--end::Product Order Tab content-->

                {{-- REVISION CONTENT --}}
                
                @include('form-modal._form-create-revisi')
                <!--begin::Histori Revisi Tab content-->
                <div class="tab-content mb-5">
                    <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">{{__('Histori Revisi')}}</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Histori Revisi ini digukan untuk dokumen penawaran</span>
                        </h3>

                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Klik untuk menambah revisi">
                            <a href="" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"> 
                                <i class="ki-duotone ki-plus fs-2"></i>{{__('Tambah Revisi')}}
                            </a>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="kt_modal_add_user">
                                <!--begin::Table head-->
                                <thead style="background-color: white;">
                                    <tr class="text-gray-500 fw-bold fs-7 text-uppercase">
                                        <th class="w-25px">No.</th>
                                        <th class="min-w-25px">Revisi Nomer</th>
                                        <th class="min-w-350px">Deskripsi</th>
                                        <th class="min-w-150px text-end">Di buat</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ( $orderdetail->revisiquotation as $item )
                                        <tr>
                                            <td>
                                                <span class="fw-bold d-block fs-6">  {{ $loop->iteration }}.</span>                           
                                            </td>
                                            <td>
                                                <span class="fw-bold d-block fs-6">Rev.{{$item->revision_number}}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start flex-shrink-0">
                                                    <span class="fw-bold d-block fs-7">{{$item->revision_description}}</span>

                                                    <a href="javascript:;" class="edit-revisi menu-link px-3" 
                                                    data-kt-user-id="{{ $item->id }}"
                                                    data-kt-user-name="{{ $item->revision_number }}" 
                                                    data-kt-user-deskripsi="{{ $item->revision_description }}">
                                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-end flex-shrink-0">
                                                <span class="fw-bold d-block fs-7 me-4 pt-3">{{  App\Helpers\Helper::dateFormat($item->created_at, 'd/m/Y - H:i') }}</span>

                                                @if ($loop->last)
                                                <a href="{{ route('admin.sendEmailAndRedirect', ['id' => $orderdetail->id]) }}" class="btn btn-sm btn-light-primary">
                                                    <i class="ki-duotone ki-send fs-2"><span class="path1"></span><span class="path2"></span></i>Kirim Email
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->

                </div>
                
                <!--end::Histori Revisi Tab content-->

                {{-- TERM CONTENT --}}
                {{-- @include('admin.order-admin._form-create-term') --}}
                <!--begin::Term Tab content-->
                <div class="tab-content mb-5" id="kt_modal_term">
                    <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">{{__('Syarat & Ketentuan Pembayaran')}}</span>

                            <span class="text-muted mt-1 fw-semibold fs-7">Syarat & Ketentuan Pembayaran digukan untuk dokumen penawaran</span>
                        </h3>

                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Klik untuk mengubah deskripsi">
                            <a href="{{ route('term-payment.edit', $orderdetail->termpayment->id) }}" class="btn btn-sm btn-info btn-active-primary edit-termpayment">
                                <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                {{__('Deskripsi')}}
                            </a>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead style="background-color: white;">
                                    <tr class="text-gray-500 fw-bold fs-7 text-uppercase">
                                        
                                        <th class="min-w-350px">Deskripsi</th>
                                        <th class="min-w-150px text-end">Di buat</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="fw-bold d-block fs-7">{!!$orderdetail->termpayment->payment_description!!}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold d-block fs-6">{{  App\Helpers\Helper::dateFormat($orderdetail->termpayment->created_at, 'd/m/Y - H:i') }}</span>
                                        </td>
                                    </tr> 
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->

                </div>
                <!--end::Term Tab content-->

                {{-- PO CONTENT --}}
                @include('form-modal._form-po')
                <!--begin::Term Tab content-->
                <div class="tab-content mb-5" id="kt_modal_po_order">
                    <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">{{__('Purchase Order')}}</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Dokumen Purchase Order ini akan memastikan bahwa orderan telah complete</span>
                        </h3>

                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Klik untuk upload file purchase order">
                            <a href="" class="btn btn-sm btn-light btn-active-primary po" data-bs-toggle="modal" data-bs-target="#kt_modal_po"
                                data-kt-po-id="{{ $orderdetail->id }}">
                                <i class="ki-duotone ki-file-up fs-2"><span class="path1"></span><span class="path2"></span></i>{{__('Upload PO')}}
                            </a>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        @if ($orderdetail->po_path)
                            <iframe class="rounded" src="{{ Storage::url($orderdetail->po_path) }}" frameborder="0" width="100%" height="600px">
                            </iframe>
                        @endif
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->

                </div>
                <!--end::Term Tab content-->
                <!--end::Layout-->
                {{-- END CONTEN --}}

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
<!--begin::Vendors Javascript(used by this page)-->
<script src="{{ url('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->

<script src="{{ url('pages/js/manage_order/data-table.js') }}"></script>
<script src="{{ url('pages/js/manage_revisi/form-create.js') }}"></script>
<script src="{{ url('pages/js/manage_revisi/form-delivery.js') }}"></script>
<script src="{{ url('pages/js/manage_revisi/form-discount.js') }}"></script>
<script src="{{ url('pages/js/manage_revisi/form-po.js') }}"></script>
<script src="{{ url('pages/js/manage_revisi/form-attachment.js') }}"></script>
<script src="{{ url('pages/js/manage_revisi/form-weight.js') }}"></script>

@endpush
</x-app-layout>