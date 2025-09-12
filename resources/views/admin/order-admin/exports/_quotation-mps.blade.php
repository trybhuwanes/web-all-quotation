<!DOCTYPE html>
<html>

<head>

    @php
        $judulDokumen = 'Quotation_' . $orderfind->user->company . '_' . now()->format('Ymd');
    @endphp

    <title>{{ $judulDokumen }}</title>
    <title>{{ $judulDokumen }}</title>
    <link href="{{ url('template/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ public_path('template/assets/css/Grinviropdf.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Cover page dengan gambar -->
    <div class="cover-page page-break"
        style="background: url('file://{{ public_path('quot/mps/cover-mps.webp') }}') no-repeat center center; background-size: cover;">
        <div class="cover-heading">
            <div class="cover-title mb-0">
                QUOTATION
            </div>
            <div class="cover-subtitle mb-0">
                {{ $orderfind->items->first()->product->nama_produk }} <br> 
                Type: {{ $productMainSpecification->type_name }}
            </div>
            <div class="cover-subsubtitle mt-0">
                <br><span>Owner: {{ $orderfind->user->company }}</span>
                @if ($orderfind->shipping->company_destination)
                    <br>Shipping to: {{$orderfind->shipping->company_destination}}
                @else
                    <br>Shipping to: {{$orderfind->user->company}}
                @endif
            </div>
        </div>
    </div>
    <!-- End Cover page -->

    <!-- Halaman 2 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=2 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5 text-center">
                DOCUMENT REVISION RECORD
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header text-center fw-bold">
                        <th style="width: 30%;" class="highlight-header">
                            Date
                        </th>
                        <th style="width: 20%;" class="highlight-header">
                            Revision
                        </th>
                        <th style="width: 50%;" class="highlight-header">
                            Description
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderfind->revisiquotation as $item)
                        <tr>
                            <td>
                                {{ App\Helpers\Helper::dateFormat($item->created_at, 'd F Y') }}
                            </td>
                            <td>
                                Rev.{{ $item->revision_number }}
                            </td>
                            <td>
                                {{ $item->revision_description }}
                            </td>
                        </tr>
                    @endforeach
                    <!-- Baris kosong -->
                    @for ($i = 0; $i < $remainingRows; $i++)
                        <tr>
                            <td style="padding: 20px;"></td>
                            <td style="padding: 20px;"></td>
                            <td style="padding: 20px;"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=2 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 2-->

    <!-- Halaman 3 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=3 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">

            <div class="content">
                <br><p>Tangerang, {{ App\Helpers\Helper::dateFormat(now(), 'd') }}<sup>th</sup>
                    {{ App\Helpers\Helper::dateFormat(now(), 'F Y') }}
                </p><br>

                <p>
                    @if ($orderfind->shipping->company_destination)
                        {{$orderfind->shipping->company_destination}}
                    @else
                        {{$orderfind->user->company}}
                    @endif
                    <br>
                    {{$orderfind->shipping->country_destination}} – Indonesia
                </p>
                <p>
                    @if ($orderfind->shipping->company_destination)
                        <br>To Whom It May Concern
                    @else
                        <br>Up Mr/Mrs {{$orderfind->user->name}}
                    @endif
                </p>
                <p>
                    Subject:
                    <em>{{ $orderfind->items->first()->product->nama_produk }} -
                        {{ $productMainSpecification->type_name }} Quotation</em>
                </p>
                <p>
                    We thank you for your above-referenced inquiry and are pleased to submit our quotation for your
                    consideration. Please see the next page for a summary of our offer. Full details can be found in
                    subsequent pages.
                </p>
                <p>
                    We hope you find our quotation in line with your requirements. However, if you have any questions,
                    please do not hesitate to contact us.
                </p>
                <br>
                <p> Sincerely, </p><br><br>
                <p class="mt-1">
                    {{ $orderfind->pic->name }}
                    <span>{{ $orderfind->pic->job_title }}</span>
                    <br />
                    <span>PT GUNA HIJAU INOVASI</span><span> - GRINVIRO GLOBAL</span>
                    <br />
                    <span>Email: {{ $orderfind->pic->email }}</span>
                    <br />
                    <span>Mobile: {{ $orderfind->pic->phone }}</span>
                </p>
            </div>

        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=3 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 3-->

    <!-- Halaman 4 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=4 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <div class="daftar-isi">
                <h5 class="text-center">
                    DAFTAR ISI
                </h5>
                <table class="toc">
                    <tr>
                        <td class="title">Cover</td>
                        <td class="dots"></td>
                        <td class="page">1</td>
                    </tr>
                    <tr>
                        <td class="title">Document Revision Record</td>
                        <td class="dots"></td>
                        <td class="page">2</td>
                    </tr>
                    <tr>
                        <td class="title">Cover Letter</td>
                        <td class="dots"></td>
                        <td class="page">3</td>
                    </tr>
                    <tr>
                        <td class="title">Daftar Isi</td>
                        <td class="dots"></td>
                        <td class="page">4</td>
                    </tr>
                    <tr>
                        <td class="title">A. Equipment Overview</td>
                        <td class="dots"></td>
                        <td class="page">5</td>
                    </tr>
                    <tr>
                        <td class="title">B. Commercial Quotation</td>
                        <td class="dots"></td>
                        <td class="page">6</td>
                    </tr>
                    <tr>
                        <td class="title">C. Technical Data</td>
                        <td class="dots"></td>
                        <td class="page">7</td>
                    </tr>
                    <tr>
                        <td class="title">D. Material And Mode Of Main Parts</td>
                        <td class="dots"></td>
                        <td class="page">8</td>
                    </tr>
                    <tr>
                        <td class="title">E. Scope Of Supply</td>
                        <td class="dots"></td>
                        <td class="page">9</td>
                    </tr>
                    <tr>
                        <td class="title">F. Term And Condition</td>
                        <td class="dots"></td>
                        <td class="page">11</td>
                    </tr>
                    <tr>
                        <td class="title">G. Drawing Of MPS</td>
                        <td class="dots"></td>
                        <td class="page">12</td>
                    </tr>
                    <tr>
                        <td class="title">H. Project References</td>
                        <td class="dots"></td>
                        <td class="page">13</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=4 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 4-->

    <!-- Halaman 5 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=5 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content" style="font-size: 11px;">
            <div class="mb-2">
                <h5 class="mt-1 mb-2">A. Equipment Overview</h5>
                <p>
                    <b>FLOWREX Multi Plate Screw Press</b> is an innovative and highly efficient dewatering system designed
                    to meet the demands of modern wastewater treatment processes. Engineered with precision and advanced
                    technology, this equipment offers a reliable, cost-effective, and low-maintenance solution for sludge
                    dewatering across various industries, including municipal, industrial, and food processing sectors.
                </p>
            </div>
            
            <div class="mb-2">
                <h5 class="mt-1 mb-2">How It Works</h5>
                <p>Multiplate Screw Press is composed of screw body, driving device, filtrate 
                    receiver, mixing system and frame. When the dewatering machine operates,
                    sludge will be transported to the mixing tank by sludge feed pump, at the same
                    time, the solid polymer has been added to the mixing tank quantitatively by
                    the polymer feed pump. Mixing motor drives the whole mixing system to
                    make the sludge and polymer fully mixed and then flocs will be produced.
                    When the liquid level arrives at the superior level of the liquid level sensor, the
                    liquid level sensor gets the signal to make the motor of screw body operates,
                    then begins to press the sludge which has flows into the screw body. Sludge
                    will be transported to the outlet step by step by the effect of screw shaft;
                    filtrate will flow out by the space of fixed annular plates and moveable annular
                    plates. <br>
                    In general, Multiplate Screw Press which uses the screw extrusion principle is a new type of
                    solid-liquid separation device. It reaches the
                    goal of extrusion dewatering sludge by the powerful extrusion pressure of changing the screw diameter
                    and distance, and the tiny spacing
                    between moveable annular plates and fixed annular plates.
                </p>
            </div>
            
            <h5 class="mt-1 mb-0">Key Features</h5>
            <div style="text-align: center;">
                <img src="{{ public_path('/quot/mps/key-features-mps.webp') }}" 
                    alt="MPS Key Features" 
                    style="width:80%; height:auto;">
            </div>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=5 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 5-->


    <!-- Halaman 6 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=6 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content-commercial">
            <h5 class="mt-1 mb-0">B. Commercial Quotation</h5>

            <p class="mt-0">The following is the price for <strong>{{ $orderfind->items->first()->product->nama_produk }} -
                    {{ $productMainSpecification->type_name }}</strong>. Please see item specific pages for more
                details.</p>

            <table class="table table-bordered table-mps">
                <thead>
                    <tr class="highlight-header text-center fw-bold">
                        <th>No</th>
                        <th>Series</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orderfind->items->isNotEmpty())

                        @foreach ($orderfind->items as $item)
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
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($item->productadd)
                                        <div class="fw-bold text-gray-900">
                                            {{ $item->productadd->nama_produk_tambahan }}</div>
                                    @else
                                        <div class="fw-bold text-gray-900">{{ $item->product->nama_produk }} -
                                            {{ $productMainSpecification->type_name }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->productadd)
                                        @idr($item->custom_price ?? $item->productadd->harga_produk_tambahan)
                                    @else
                                        <div class="fw-bold text-gray-800">@idr($productMainSpecification->harga)</div>
                                    @endif
                                </td>
                                <td><span>{{ $item->quantity }} unit</span></td>
                                <td>
                                    @if ($item->productadd)
                                        @idr($item->custom_price ?? $item->productadd->harga_produk_tambahan)
                                    @else
                                        @idr($subtotal)
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" class="text-end"><strong>Sub Total</strong></td>
                            <td>@idr($orderfind->subtotal)</td>
                        </tr>
                        
                        @if ($orderfind->shipping)
                            <tr>
                                <td colspan="4" class="text-end"><strong>Biaya Pengiriman *</strong></td>
                                <td>
                                    @if (!is_null($orderfind->shipping->shipping_cost))
                                        @idr($orderfind->shipping->shipping_cost)
                                    @else
                                        Harga pengiriman belum diinput
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if ($orderfind->discount_amount != 0)
                            <tr>
                                <td colspan="4" class="text-end"><strong>Diskon</strong></td>
                                <td>
                                    @if ($orderfind->discount_type === 'fixed')
                                        -@idr($orderfind->discount_amount)
                                    @else
                                        -@idr(($orderfind->discount_amount)/100 * ($orderfind->subtotal)) ({{ (int)$orderfind->discount_amount }}%)
                                    @endif
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td colspan="4" class="text-end"><strong>Grand Total (Exclude PPN)</strong></td>
                            <td>
                                @if ($orderfind->shipping->shipping_cost)
                                    @idr($orderfind->total_price + $orderfind->shipping->shipping_cost)
                                @else
                                    @idr($orderfind->total_price)
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5">Order Tidak ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <p class="notes mb-0">
                *Delivery Time: 50-60 working days.</br>
                **Prices do not include 11% VAT and should be added during payment
            </p>

            <p class="notes mb-0">
                <strong>Notes:</strong>
                @if ($orderfind->notecommercil)
                    {!! $orderfind->notecommercil->notes_description !!}
                @endif
            </p>

        </div>
        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=6 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 6-->

    <!-- Halaman 7 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=7 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mb-2 mt-1">C. Technical Data</h5>
            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header fw-bold">
                        <th class="text-center text-bold nopading" colspan="2">
                            Item
                        </th>
                        <th class="text-center text-bold nopading">
                            Parameter
                        </th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td class="nopading" rowspan="11">Parameter Design</td>
                        <td class="nopading">Type</td>
                        <td class="nopading">{{ $productMainSpecification->type_name }}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Dimension</td>
                        <td class="nopading">
                            L{{ $productMainSpecification->dimension_l }}×W{{ $productMainSpecification->dimension_w }}×H{{ $productMainSpecification->dimension_h }}
                            (mm) (Estimated)</td>
                    </tr>
                    <tr>
                        <td class="nopading">Solid Content</td>
                        <td class="nopading">10000~50000mg/L (Estimated)</td>
                    </tr>
                    <tr>
                        <td class="nopading">Capacity</td>
                        <td class="nopading">
                            {{ $productMainSpecification->dry_solids_min }}~{{ $productMainSpecification->dry_solids_max }}
                            kg-DS/h (Estimated)</td>
                    </tr>
                    <tr>
                        <td class="nopading">Power</td>
                        <td class="nopading">{{ $productMainSpecification->power_kw }} kW (Estimated)</td>
                        {{-- 0.95 kW (Estimated) --}}
                    </tr>
                    <tr>
                        <td class="nopading">Protection Level</td>
                        <td class="nopading">IP55 F</td>
                    </tr>
                    <tr>
                        <td class="nopading">Power Supply</td>
                        <td class="nopading">380V/3PH/50Hz</td>
                    </tr>
                    <tr>
                        <td class="nopading">Output Sludge, Moisture Content</td>
                        <td class="nopading">80-85%</td>
                    </tr>
                    <tr>
                        <td class="nopading">Polymer Feeding Rate</td>
                        <td class="nopading">DS 0.2~1%</td>
                    </tr>
                    <tr>
                        <td class="nopading">Flush Water</td>
                        <td class="nopading">{{ $productMainSpecification->quot_pd_flush_water }}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Water Supply Pressure</td>
                        <td class="nopading">≥0.2MPa</td>
                    </tr>
                    <tr>
                        <td class="nopading" rowspan="4">Screw Body</td>
                        <td class="nopading">Specification × Length</td>
                        <td class="nopading">{{ $productMainSpecification->quot_sc_specification_length }}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Quantity</td>
                        <td class="nopading">{{ $productMainSpecification->quot_sc_quantity }}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Material</td>
                        <td class="nopading">Plate: SS304; Screw Shaft: SS304</td>
                    </tr>
                    <tr>
                        <td class="nopading">Motor Power</td>
                        <td class="nopading">{{ $productMainSpecification->quot_sc_motorpower }}</td>
                    </tr>

                    <tr>
                        <td class="nopading" rowspan="4">Flocculated Mix Tank</td>
                        <td class="nopading">Dimension</td>
                        <td class="nopading">{{ $productMainSpecification->quot_fmt_dimension }}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Volume</td>
                        <td class="nopading">{{ $productMainSpecification->quot_fmt_volume }}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Material</td>
                        <td class="nopading">SS304</td>
                    </tr>
                    <tr>
                        <td class="nopading">Motor Power</td>
                        <td class="nopading">{{ $productMainSpecification->quot_fmt_motorpower }}</td>
                    </tr>

                    <tr>
                        <td class="nopading">Electrical</td>
                        <td class="nopading">Function</td>
                        <td class="nopading">1. Frequency converting controls dewatering body.<br>
                            2. Frequency converting controls polymer mixing device.<br>
                            3. Realize the switch of automatic operation and manual operation.
                        </td>
                    </tr>

                    <tr>
                        <td class="nopading" colspan="2">Equipment Weight</td>
                        <td class="nopading">{{ $productMainSpecification->quot_equipment_weight }}</td>
                    </tr>
                    <tr>
                        <td class="nopading" colspan="2">Operating Weight</td>
                        <td class="nopading">{{ $productMainSpecification->quot_operating_weight }}</td>
                    </tr>
                    <tr>
                        <td class="nopading" colspan="2">Work Time</td>
                        <td class="nopading">{{ $productMainSpecification->quot_work_time }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=7 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 7-->

    <!-- Halaman 8 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=8 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-1 mb-2">D. Material and Mode of Main Parts</h5>
            <table class="table table-bordered mt-0">
                <thead>
                    <tr class="highlight-header fw-bold">
                        <th class="text-center nopading">No</th>
                        <th class="text-center nopading">Name</th>
                        <th class="text-center nopading">Material</th>
                        <th class="text-center nopading">Brand or Manufacture</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center nopading">1</td>
                        <td class="nopading">Fixed Annular Plate</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">2</td>
                        <td class="nopading">Moveable Annular Plate</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">3</td>
                        <td class="nopading">Screw Shaft</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">4</td>
                        <td class="nopading">Filtrate Receiver</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">5</td>
                        <td class="nopading">Mixing Tank</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">6</td>
                        <td class="nopading">Mixing Shaft and Blades</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">7</td>
                        <td class="nopading">Motor Brackets</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">8</td>
                        <td class="nopading">Sludge Inlet Pipe</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">10</td>
                        <td class="nopading">Flushing System</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">11</td>
                        <td class="nopading">Reducer for Screw Body</td>
                        <td class="nopading">Finished Product</td>
                        <td class="nopading">Chinese Brand WUMA/TONGLI</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">12</td>
                        <td class="nopading">Reducer for Mixing Shaft</td>
                        <td class="nopading">Finished Product</td>
                        <td class="nopading">Chinese Brand WUMA/TONGLI</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">13</td>
                        <td class="nopading">Liquid Level Switch</td>
                        <td class="nopading">Finished Product</td>
                        <td class="nopading">Omron</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">14</td>
                        <td class="nopading">Solenoid Valve</td>
                        <td class="nopading">Finished Product</td>
                        <td class="nopading">ASCO/SMC</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">15</td>
                        <td class="nopading">Frequency converter for screw body motor</td>
                        <td class="nopading">Finished Product</td>
                        <td class="nopading">Schneider/Fuji/Yaskawa</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">16</td>
                        <td class="nopading">Frequency converter for mixing motor</td>
                        <td class="nopading">Finished Product</td>
                        <td class="nopading">Schneider/Fuji/Yaskawa</td>
                    </tr>
                    <tr>
                        <td class="text-center nopading">17</td>
                        <td class="nopading">Electrical Cabinet</td>
                        <td class="nopading">SS304</td>
                        <td class="nopading">FLOWREX</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=8 />
        <!-- End Footer -->
    </div>
    <!-- Halaman 8 -->

    <!-- Halaman 9 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=9 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-2 mb-2">E. Scope of Supply</h5>

            <table class="table table-bordered nopadding mt-0">
                <thead>
                    <tr class="highlight-header text-center fw-bold">
                        <th>No</th>
                        <th>Components</th>
                        <th>Grinviro</th>
                        <th>Client</th>
                        <th>Description</th>
                    </tr>
                </thead>


                <tbody>
                    <tr>
                        <td rowspan="3" class="text-center">1</td>
                        <td class="ps-0 fw-bold">{{ __('Equipment MPS') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="p-0">Panel control (only for MPS)</td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0 text-center"></td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0">MPS</td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0 text-center"></td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="4" class="text-center">2</td>
                        <td class="ps-0 fw-bold">{{ __('Chemical Dosing') }}</td>
                        <td></td>
                        <td></td>
                        <td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0" class="description">Dosing Pump and skid</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Dosing Pump') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Dosing Pump') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0" class="description">Agitator + Chemical Tank</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Agitator + Chemical Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Agitator + Chemical Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0">For type 101-303</td>
                    </tr>
                    <tr>
                        <td class="p-0" class="description">APP (Automatic Polymer Preparation)</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'APP (Automatic Polymer Preparation)') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'APP (Automatic Polymer Preparation)') ? '√' : '' }}
                        </td>
                        <td class="p-0">For type 401-403</td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="text-center">3</td>
                        <td class="ps-0 fw-bold">{{ __('Tank') }}</td>
                        <td></td>
                        <td></td>
                        <td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Chemical Tank</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Chemical Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Chemical Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Sludge Tank</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Sludge Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Sludge Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Filtrat Tank</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Filtrat Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Filtrat Tank') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="3" class="text-center">4</td>
                        <td class="ps-0 fw-bold">{{ __('Pump') }}</td>
                        <td></td>
                        <td></td>
                        <td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Feed Pump</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Filtrat Pump</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="5" class="text-center">5</td>
                        <td class="ps-0 fw-bold">{{ __('Interconnection') }}</td>
                        <td></td>
                        <td></td>
                        <td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Cable from Main Panel to Local Panel</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Cable from Main Panel to Local Panel') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Cable from Main Panel to Local Panel') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Interconnection Pipe from Feed Pump to Equipment</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Interconnection Pipe') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Interconnection Pipe') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Clean water washing tube connection</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Clean water washing tube connection') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Clean water washing tube connection') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Chemical Connection</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Chemical Connection') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Chemical Connection') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="4" class="text-center">6</td>
                        <td class="ps-0 fw-bold">{{ __('Civil and Structural Works') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Foundation</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Civil & Structural Work - Foundation') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Civil & Structural Work - Foundation') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Shelter</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Civil & Structural Work - Shelter') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Civil & Structural Work - Shelter') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Maintenance platform and safety handrails</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Maintenance platform and safety handrails') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Maintenance platform and safety handrails') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="text-center">7</td>
                        <td class="ps-0 fw-bold">{{ __('Testing and commissioning') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Chemical during commissioning</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Chemical') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Chemical') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Sufficient water and electricity during the commissioning</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Sufficient water and electricity') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Sufficient water and electricity') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Offline training</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Offline Training') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Offline Training') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=9 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 9-->


    <!-- Halaman 10 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=10 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <table class="table table-bordered nopadding">
                <thead>
                    <tr class="highlight-header text-center fw-bold">
                        <th>No</th>
                        <th>Components</th>
                        <th>Grinviro</th>
                        <th>Client</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td rowspan="3" class="text-center">8</td>
                        <td class="ps-0 fw-bold">{{ __('Document') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Installation Manual Book</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Installation Manual Book') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Installation Manual Book') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Packing list</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Packing list') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Packing list') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="2" class="text-center">9</td>
                        <td class="ps-0 fw-bold">{{ __('Authority Submission') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Any/All Insurance and Taxes Not Specially Hughlighted/Mentioned in
                            This document</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="4" class="text-center">10</td>
                        <td class="ps-0 fw-bold">{{ __('Others') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Shipping to onsite</td>
                        <td class="p-0 text-center">{{ $orderfind->shipping?->use_shipping_to_onsite ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">{{ !$orderfind->shipping?->use_shipping_to_onsite ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Unloading Equipment (positioning on foundation)</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Supervision of Installation</td>
                        <td class="p-0 text-center">
                            {{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Supervision of Installation') ? '√' : '' }}
                        </td>
                        <td class="p-0 text-center">
                            {{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Supervision of Installation') ? '√' : '' }}
                        </td>
                        <td class="p-0"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=10 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 10-->

    <!-- Halaman 11 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=11 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-2 mb-2">F. Term and Condition</h5>
            <table class="table table-bordered mt-0">
                <tbody>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Terms</td>
                        <td style="width: 80%;">
                            Cost And Freight (CFR)
                            {{ $orderfind->shipping->country_destination ?? '...' }},
                            {{ $orderfind->shipping->state_destination ?? '...' }},
                            Indonesia
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Payments</td>
                        @if ($orderfind->termpayment)
                            <td style="width: 80%;">
                                {!! $orderfind->termpayment->payment_description !!}
                            </td>
                        @else
                            <td style="width: 80%;">
                                <ul>
                                    <li>Payment – 1: 30% Down Payment</li>
                                    <li>Payment – 2: 70% after Ready to Dispatch from Grinviro Workshop</li>
                                </ul>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Due Dates</td>
                        <td style="width: 80%;">
                            All invoices are due and payable at the specified payment date or fourteen (14) days after
                            invoice date if no payment schedule has been specified in the Sales Oder Contract or in
                            Seller’s confirmation of order. In case Buyer defaults in payment, Buyer shall be subject to
                            a default late payment penalty of 1.0% of the outstanding amounts due to Seller for every
                            calendar week or part thereof.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Packing</td>
                        <td style="width: 80%;">
                            All items will be packed accordingly for safe transport.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Warranty</td>
                        <td style="width: 80%;">
                            Warranty period: 1 year
                            Warranty limit:
                            The warranty does not cover the following:
                            Damage caused by natural disasters, riots, war and other force majeure factors.
                            Damage caused by improper use, negligence, accidents or improper use by the user.
                            Shipping costs incurred for the return of the product.
                            Costs incurred for postage of product parts during the warranty period.
                            Travel costs for out-of-warranty repairs.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Validity</td>
                        <td style="width: 80%;">
                            1 month from issue date
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; padding-left: 10px">Taxes</td>
                        <td style="width: 80%;">
                            *Excluded all Indonesia goverment taxes (excluded PPN 11%)
                        </td>
                    </tr>
                </tbody>
            </table>
            *Notes: taxes should be paid accordingly to Indonesia government taxes regulation and should be included
            during paymen

        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=11 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 11-->

    <!-- Halaman 12 -->
    <div class="page mx-15 page-break">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=12 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-2">G. Drawing of MPS</h5>

            {{-- <div class="row"> --}}
            <div class="row text-center">
                <div class="col-12">
                    <img src="{{ public_path('./quot/mps/drawing-mps.webp') }}" alt="Gambar 1" class="img-fluid"
                        style="width: 75%;">
                </div>
            </div>
            {{-- </div> --}}
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=12 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 12-->

    <!-- Halaman 13 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=13 :countpage=13 />
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-2">H. Project References</h5>

            <div class="text-center">

                <!-- Gambar 1 -->
                <div class="avoid-break" style="margin-bottom:10px; text-align:center;">
                    <img src="{{ public_path('./quot/mps/produk-mps.webp') }}" alt="Gambar 1"
                        style="width:70%; max-height:300px; object-fit:contain;">
                </div>

                <!-- Gambar 2 & 3 sejajar -->
                <div class="avoid-break" style="margin-bottom:10px;">
                    <table width="100%" style="text-align:center; border:none;">
                        <tr>
                            <td width="50%" align="center">
                                <img src="{{ public_path('./quot/mps/example-mps.webp') }}" alt="Gambar 2"
                                    style="width:90%; max-height:200px; object-fit:contain;">
                            </td>
                            <td width="50%" align="center">
                                <img src="{{ public_path('./quot/mps/sample-mps.webp') }}" alt="Gambar 3"
                                    style="width:90%; max-height:200px; object-fit:contain;">
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- QR Code -->
                <div class="avoid-break" style="margin-top:10px; text-align:center;">
                    <img src="{{ public_path('./quot/mps/qr-code-mps.webp') }}" alt="Gambar 4"
                        style="width:20%; max-height:150px; object-fit:contain;">
                </div>

            </div>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=13 />
        <!-- End Footer -->
    </div>
    <!-- End Halaman 13-->

</body>

</html>