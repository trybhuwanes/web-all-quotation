<html>

<head>
    <link href="{{ url('template/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @media print {
            .print-hidden {
                visibility: hidden;
            }
        }

        .three-columns {
        display: grid;
        grid-template-columns: 99% 1%;
        grid-auto-rows: auto;
        }

        .three-columns .cell {
            padding: 0 8px 8px 0;
        }

        .three-columns .label {
            font-weight: bold;
        }

        .three-columns .value {
            text-align: left;
        }

        .btn-print {
            position:fixed;
            bottom:10px;
            right:10px;
            font-size:25px;                
            padding:15px 25px;
            border:none;
            border-radius:40px;
            box-shadow:0 4px 8px rgba(0,0,0,0.3);
            cursor:pointer;
        }
    </style>
</head>

<body style="font-size: 4px;">
    <div class="row gx-0">
        <div class="card border border-gray-500">
            <!-- begin::Body-->
            <div class="card-body">
                <!-- begin::Wrapper-->
                <div class="mx-auto">
                    <!-- begin::Header-->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-start">
                            <!--begin::Logo-->
                            <div href="#" class="d-block mw-150px">
                                <x-app-logo alt="Logo" class="h-30px mb-4"></x-app-logo>
                            </div>
                            <!--end::Logo-->
                        </div>
                        <div class="text-end">
                            <h4 class="fw-bolder text-gray-800 fs-2xl">
                                No. Order: {{ $orderfind->trx_code}}
                            </h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    
                    <!--begin::Wrapper-->
                    {{-- <div class="flex-column gap-3"> --}}
                        <!--begin::Separator-->
                        <div class="separator mt-5 mb-3"></div>
                        <!--begin::Separator-->
                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10">
                            <div class="flex-root d-flex flex-column">
                                <h1><span class="text-muted fw-bold fw-italic fs-5"><u>Data Pembeli</u></span></h1>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Nama</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $orderfind->user->name ?? '-' }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Email</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $orderfind->user->email ?? '-' }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">No. Telpon</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ isset($orderfind->user->phone) ? '0'.substr($orderfind->user->phone, 2) : '-' }}</td>
                                    </tr>
                                </span>
                            </div>
    
                            
                        </div>
                        <!--begin:Order summary-->

                        <!--begin::Separator-->
                        <div class="separator mt-2 mb-2"></div>
                        <!--begin::Separator-->
                        
                        {{-- <table class="three-columns">
                            
                        </table> --}}
                        
                        
                        <h1><span class="text-muted fw-bold fw-italic fs-5"><u>Barang</u></span></h1>
                        <div class="separator mt-2 mb-2"></div>
                        <!--begin::Table-->
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
                                            // Initialize variables
                                            $harga = 0;
                                            if ($item->product) {
                                                $harga = $item->product->harga;
                                            } elseif ($item->productadd) {
                                                $harga = $item->productadd->harga_produk_tambahan;
                                            }

                                            // Calculate subtotal
                                            $subtotal = $harga * ($item->quantity ?? 0);
                                            // $grandTotal += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Title-->
                                                    <div class="ms-0">
                                                        @if ($item->productadd)
                                                            <div class="fw-bold text-gray-900">{{ $item->productadd->nama_produk_tambahan }}</div> 
                                                        @else
                                                            <div class="fw-bold text-gray-900">{{ $item->product->nama_produk }}</div> 
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
                                                    <div class="fw-bold text-gray-800">@idr($item->productadd->harga_produk_tambahan)</div> 
                                                @else
                                                    <div class="fw-bold text-gray-800">@idr($item->product->harga)</div>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @idr($subtotal)
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    {{-- <tr>
                                        <td colspan="4" class="text-end">
                                            Subtotal
                                        </td>
                                        <td class="text-end">
                                            $264.00
                                        </td>
                                    </tr> --}}
                                    
                                    <tr>
                                        <td colspan="3" class="fs-3 text-gray-900 text-end">
                                            Total Harga
                                        </td>
                                        <td class="text-gray-900 fs-3 fw-bolder text-end">
                                            @idr($orderfind->total_price)
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table-->
                        <!--end:Order summary-->
                    <!--end::Wrapper-->
                    <!--end::Body-->
                </div>
                <!-- end::Wrapper-->
            </div>
            <!-- end::Body-->
        </div>
    </div>


    {{-- <div style="padding:5px;background-color:#f5e3c4;width:100%;margin-top:40px">Cetak oleh:
        <i>{{ Auth::user()->name }}
            {{ auth()->user()->userable ? '(' . auth()->user()->userable->type . ')' : '' }}</i>, pada
        <i>{{  App\Helpers\Helper::dateFormat(now(), 'd F Y') }}</i>
    </div> --}}
    <button onclick="window.print();"
        class="print-hidden btn btn-info fw-bold btn-print"
        style="font-size: 20px; padding: 15px 30px;">
        <span style="font-size: 28px; margin-right: 8px;">&#x1f5b6;</span>
        PRINT
    </button>
</body>

</html>
