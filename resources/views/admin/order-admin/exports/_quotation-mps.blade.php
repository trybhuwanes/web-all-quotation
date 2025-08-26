<!DOCTYPE html>
<html>

<head>

    @php
        $judulDokumen = 'Quotation_' . $orderfind->user->company . '_' . now()->format('Ymd');
    @endphp

    <title>{{ $judulDokumen }}</title>
    <title>{{ $judulDokumen }}</title>
    <link href="{{ url('template/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        /* Page break */
        .page-break {
            page-break-after: always;
        }

        .table.nopadding,
        .table.nopadding td,
        .table.nopadding th {
            padding: 0 !important;
            margin: 0 !important;
        }

        @media print {
            .print-hidden {
                display: none;
            }

            body,
            html {
                margin: 0;
                padding: 0;
            }

            .page {
                page-break-after: always;
            }

            /* Sembunyikan tombol print saat dicetak */
            .print-hidden {
                display: none;
            }


        }

        .three-columns {
            display: grid;
            grid-template-columns: 99% 1%;
            grid-auto-rows: auto;
        }

        .three-columns .cell {
            padding: 0 2px 2px 0;
        }

        .three-columns .label {
            font-weight: bold;
        }

        .three-columns .value {
            text-align: left;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid black;
        }

        .table tbody tr:last-child td {
            border: 1px solid black !important;
        }

        .table> :not(:last-child)> :last-child>* {
            border: 1px solid black !important;
        }

        .table tbody tr td.nopading {
            padding: 1px !important;
        }
        .table tbody tr th.nopading {
            padding: 1px !important;
        }

        .table thead tr.nopading {
            padding: 0px !important;
        }
        
        .table tbody tr.nopading {
            padding: 0px !important;
        }

        .highlight-header {
            background-color: #0f243e !important;
            color: white !important;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .company-name {
            font-weight: bold;
        }

        .sub-title {
            font-size: 0.9em;
        }

        .no-border-right {
            border-right: none !important;
        }

        .no-border-left {
            border-left: none !important;
        }

        /* Style untuk halaman sampul */
        .cover-page {
            height: 100vh;
            width: 100%;
            margin: 0%;
        }

        .cover-page img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cover-heading {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fafafa;
            font-family: Arial, sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }


        /* Struktur halaman */
        .page {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            padding: 20px;
            box-sizing: border-box;
        }

        .page .content {
            flex: 1;
            margin-bottom: 60px;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            font-size: 9px;
        }

        .daftar-isi {
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
        }

        .daftar-isi h1 {
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase; /* Huruf kapital */
        }

        .toc {
            list-style: none; /* Hilangkan bullet points */
            padding: 0;
        }

        .toc li {
            display: flex; /* Flexbox untuk mengatur elemen */
            justify-content: space-between; /* Judul dan nomor halaman berjauhan */
            align-items: flex-end; /* Garis berada di bawah teks */
            margin: 10px 0;
        }
        
        .toc li span {
            white-space: nowrap; /* Mencegah teks terpotong */
        }

        .toc .line {
            flex-grow: 1; /* Membuat garis titik memenuhi ruang */
            border-bottom: 1px dotted #000; /* Garis titik-titik */
            margin: 0 2px; /* Jarak antara teks dan garis */
            position: relative; /* Pastikan garis tetap di bawah */
        }

        .toc .page-number {
            text-align: right;
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

<body>
    <!-- Cover page dengan gambar -->
    <div class="cover-page">
        <img src="{{ url('/quot/mps/cover-mps.webp') }}" alt="Cover Image">
        <div class="cover-heading">
            QUOTATION <br> {{ $orderfind->items->first()->product->nama_produk }} - {{ $productMainSpecification->type_name}}
            <br><span>{{$orderfind->user->company}}</span>
        </div>
    </div>
    <div class="page-break"></div>
    <!-- End Cover page -->

    <!-- Halaman 2 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=2 :countpage=11/>
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
                    @foreach($orderfind->revisiquotation as $item)
                        <tr>
                            <td>
                                {{  App\Helpers\Helper::dateFormat($item->created_at, 'd F Y') }}
                            </td>
                            <td>
                                Rev.{{$item->revision_number}}
                            </td>
                            <td>
                                {{$item->revision_description}}
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
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=2/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 2-->

    <!-- Halaman 3 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=3 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">

            <div class="content">
                <p>Tangerang, {{  App\Helpers\Helper::dateFormat(now(), 'd') }}<sup>th</sup>
                    {{  App\Helpers\Helper::dateFormat(now(), 'F Y') }}
                </p><br><br><br><br>

                <p>
                    {{$orderfind->user->company}}
                    <br />
                    {{$orderfind->user->location_company}} – Indonesia
                </p><br><br>
                <p>
                    Up. Mr/Mrs. {{$orderfind->user->name}}
                </p><br>
                <p>
                    Subject:
                    <em>{{ $orderfind->items->first()->product->nama_produk }} - {{ $productMainSpecification->type_name}} Quotation</em>
                </p><br><br><br>
                <p>
                    We thank you for your above-referenced inquiry and are pleased to submit our quotation for your
                    consideration. Please see the next page for a summary of our offer. Full details can be found in
                    subsequent pages.
                </p>
                <p>
                    We hope you find our quotation in line with your requirements. However, if you have any questions,
                    please do not hesitate to contact us.
                </p>
                <br><br><br><br>
                <p> Sincerely, </p>
                <br><br><br><br><br>
                <p class="mt-1">
                    {{$orderfind->pic->name}}
                    <br/>
                    <span>{{$orderfind->pic->job_title}}</span>
                    <br/>
                    <span>PT GUNA HIJAU INOVASI</span><span> - GRINVIRO GLOBAL</span>
                    <br/>
                    <span>Email: {{$orderfind->pic->email}}</span>
                    <br/>
                    <span>Mobile: {{$orderfind->pic->phone}}</span>
                </p>
            </div>

        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=3/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 3-->

    <!-- Halaman 4 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=4 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">

            <div class="content">
                <div class="daftar-isi">
                    <h5 class="text-center">
                        DAFTAR ISI
                    </h5>
                    <ul class="toc">
                        <li><span>Cover</span><div class="line"></div><span class="page-number">1</span></li>
                        <li><span>Document Revision Record</span><div class="line"></div><span class="page-number">2</span></li>
                        <li><span>Cover Letter</span><div class="line"></div><span class="page-number">3</span></li>
                        <li><span>Daftar Isi</span><div class="line"></div><span class="page-number">4</span></li>
                        <li><span>A. Equipment Overview</span><div class="line"></div><span class="page-number">5</span></li>
                        <li><span>B. Commercial Quotation</span><div class="line"></div><span class="page-number">6</span></li>
                        <li><span>C. Technical Data</span><div class="line"></div><span class="page-number">6</span></li>
                        <li><span>D. Material And Mode Of Main Parts</span><div class="line"></div><span class="page-number">7</span></li>
                        <li><span>E. Scope Of Supply</span><div class="line"></div><span class="page-number">8</span></li>
                        <li><span>F. Term And Condition</span><div class="line"></div><span class="page-number">9</span></li>
                        <li><span>G. Drawing Of MPS</span><div class="line"></div><span class="page-number">10</span></li>
                        <li><span>H. Project References</span><div class="line"></div><span class="page-number">11</span></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=4/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 4-->

    <!-- Halaman 5 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=5 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">A. Equipment Overview</h5>
                {{-- <p>Multiplate Screw Press is composed of screw body, driving device, filtrate receiver mixing system and frame.</p> --}}
                <div class="row">
                    
                    <p>FLOWREX Multi Plate Screw Press is an innovative and highly efficient dewatering system designed to meet the demands of modern wastewater treatment processes. Engineered with precision and advanced technology, this equipment offers a reliable, cost-effective, and low-maintenance solution for sludge dewatering across various industries, including municipal, industrial, and food processing sectors.</p>
                    <div class="col-7">
                        <h5>How It Works</h5>
                        <p>Multiplate Screw Press is composed of screw body, driving device, filtrate receiver, mixing system and frame. When the dewatering machine operates, sludge will be transported to the mixing tank by sludge feed pump, at the same time, the solid polymer has been added to the mixing tank quantitatively by the polymer feed pump. Mixing motor drives the whole mixing system to make the sludge and polymer fully mixed and then flocs will be produced. When the liquid level arrives at the superior level of the liquid level sensor, the liquid level sensor gets the signal to make the motor of screw body operates, then begins to press the sludge which has flows into the screw body. Sludge will be transported to the outlet step by step by the effect of screw shaft; filtrate will flow out by the space of fixed annular plates and moveable annular plates.</p>
                    </div>
                    <div class="col-5">
                        <img src="{{ url('/quot/mps/flowrex-mps.webp') }}" alt="Multiplate Screw Press" width="100%">
                        <div class="image-container">
                        </div>
                    </div>
                </div>
                <p class="mt-1">In general, Multiplate Screw Press which uses the screw extrusion principle is a new type of solid-liquid separation device. It reaches the goal of extrusion dewatering sludge by the powerful extrusion pressure of changing the screw diameter and distance, and the tiny spacing between moveable annular plates and fixed annular plates</p>
                <h5>Key Features</h5>
                <ul>
                    <li>Low Energy Consumption: The FLOWREX Multi Plate Screw Press is built for energy efficiency, requiring minimal power for operation. Its innovative design reduces overall energy consumption, resulting in significant cost savings over time.</li>
                    <li>Continuous and Automated Operation: The system is fully automated, allowing for 24/7 operation with minimal operator intervention. Its continuous dewatering process ensures consistent performance and reduced downtime, maximizing operational efficiency.</li>
                    <li>Compact and Space-Saving Design: With a compact footprint, the FLOWREX Multi Plate Screw Press is ideal for installations where space is limited. Its modular structure enables easy integration into existing facilities, providing flexibility for various plant layouts.</li>
                    <li>Clog-Free Performance: The unique multi-plate design prevents clogging and ensures smooth operation. The self-cleaning mechanism maintains consistent performance, reducing maintenance requirements and downtime</li>
                    <li>Low Noise and Vibration: Operating at low rotational speeds, the system minimizes noise and vibration levels, providing a quiet and user-friendly working environment.</li>
                    <li>High Solid Capture Rate: The advanced dewatering technology of the FLOWREX system ensures high solid capture rates, reducing sludge volume and disposal costs.</li>
                    <li>Durable and Corrosion-Resistant Materials: Constructed with high-quality stainless steel and corrosion-resistant components, the FLOWREX Multi Plate Screw Press guarantees durability, longevity, and reliable performance even in harsh environments.</li>
                </ul>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=5/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 5-->
    
    
    <!-- Halaman 6 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=6 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">B. Commercial Quotation</h5>

            <p>The following is the price for <strong>{{ $orderfind->items->first()->product->nama_produk }} - {{ $productMainSpecification->type_name}}</strong>. Please see item specific pages for more details.</p>
            
            <table class="table table-bordered">
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
                    @if($orderfind->items->isNotEmpty())

                    @foreach ($orderfind->items as $item)
                        @php
                            // Initialize variables
                            $harga = 0;
                            if ($item->product) {
                                $harga = $productMainSpecification->harga;
                            } elseif ($item->productadd) {
                                $harga = $item->productadd->harga_produk_tambahan;
                            }
                            // Calculate subtotal
                            $subtotal = $harga * ($item->quantity ?? 0);
                            // $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>
                                @if ($item->productadd)
                                    <div class="fw-bold text-gray-900">{{ $item->productadd->nama_produk_tambahan }}</div> 
                                @else
                                    <div class="fw-bold text-gray-900">{{ $item->product->nama_produk }} - {{ $productMainSpecification->type_name}}</div> 
                                @endif
                            </td>
                            <td>
                                @if ($item->productadd)
                                    -
                                @else
                                    <div class="fw-bold text-gray-800">@idr($productMainSpecification->harga)</div>
                                @endif
                            </td>
                            <td><span>{{ $item->quantity }} unit</span></td>
                            <td>
                                @if ($item->productadd)
                                    - 
                                @else
                                    @idr($subtotal)
                                @endif
                            </td>
                        </tr>
                    @endforeach

                        @if($orderfind->shipping)
                        <tr>
                            <td colspan="4" class="text-end"><strong>Harga Produk Tambahan & Biaya Pengiriman</strong></td>
                            <td>
                                @if($orderfind->shipping->shipping_cost != 0)
                                    @idr($orderfind->shipping->shipping_cost)
                                @else
                                    Harga pengiriman belum diinput
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if($orderfind->discount_amount != 0)
                        <tr>
                            <td colspan="4" class="text-end"><strong>Diskon</strong></td>
                            <td>
                                -@idr($orderfind->discount_amount)
                            </td>
                        </tr>
                        @endif
                        
                        <tr>
                            <td colspan="4" class="text-end"><strong>Grand Total (Exclude PPN)</strong></td>
                            <td>@idr($orderfind->total_price)</td>
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
                @if($orderfind->notecommercil)
                    {!! $orderfind->notecommercil->notes_description !!}
                @endif
            </p>
            
        </div>
        <!-- End Konten Utama -->

        <div class="content">
            <h5 class="mt-1">C. Technical Data</h5>
            
            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header fw-bold text-center">
                        <th class="nopading" colspan="2">
                            Item
                        </th>
                        <th class="nopading">
                            Parameter
                        </th>
                    </tr>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="nopading" rowspan="11">Parameter Design</td>
                        <td class="nopading">Type</td>
                        <td class="nopading">{{ $productMainSpecification->type_name}}</td>
                    </tr>
                    <tr>
                        <td class="nopading">Dimension</td>
                        <td class="nopading">L{{ $productMainSpecification->dimension_l }}×W{{ $productMainSpecification->dimension_w}}×H{{ $productMainSpecification->dimension_h}} (mm) (Estimated)</td>
                    </tr>
                    <tr>
                        <td class="nopading">Solid Content</td>
                        <td class="nopading">10000~50000mg/L (Estimated)</td>
                    </tr>
                    <tr>
                        <td class="nopading">Capacity</td>
                        <td class="nopading">{{ $productMainSpecification->dry_solids_min }}~{{ $productMainSpecification->dry_solids_max }} kg-DS/h (Estimated)</td>
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
                </tbody>
            </table> 
        </div>
        <!-- End Konten Utama -->
        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=6/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 6-->

    <!-- Halaman 7 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=7 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
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
        
            <h5 class="mt-5">D. Material and Mode of Main Parts</h5>
            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header fw-bold">
                        <th class="text-center nopading">No</th>
                        <th class="text-center nopading">Name</th>
                        <th class="text-center nopading">Material</th>
                        <th class="text-center nopading">Brand or Manufacture</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="nopading">1</td><td class="nopading">Fixed Annular Plate</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">2</td><td class="nopading">Moveable Annular Plate</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">3</td><td class="nopading">Screw Shaft</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">4</td><td class="nopading">Filtrate Receiver</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">5</td><td class="nopading">Mixing Tank</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">6</td><td class="nopading">Mixing Shaft and Blades</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">7</td><td class="nopading">Motor Brackets</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">8</td><td class="nopading">Sludge Inlet Pipe</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">10</td><td class="nopading">Flushing System</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                    <tr><td class="nopading">11</td><td class="nopading">Reducer for Screw Body</td><td class="nopading">Finished Product</td><td class="nopading">Chinese Brand WUMA/TONGLI</td></tr>
                    <tr><td class="nopading">12</td><td class="nopading">Reducer for Mixing Shaft</td><td class="nopading">Finished Product</td><td class="nopading">Chinese Brand WUMA/TONGLI</td></tr>
                    <tr><td class="nopading">13</td><td class="nopading">Liquid Level Switch</td><td class="nopading">Finished Product</td><td class="nopading">Omron</td></tr>
                    <tr><td class="nopading">14</td><td class="nopading">Solenoid Valve</td><td class="nopading">Finished Product</td><td class="nopading">ASCO/SMC</td></tr>
                    <tr><td class="nopading">15</td><td class="nopading">Frequency converter for screw body motor</td><td class="nopading">Finished Product</td><td class="nopading">Schneider/Fuji/Yaskawa</td></tr>
                    <tr><td class="nopading">16</td><td class="nopading">Frequency converter for mixing motor</td><td class="nopading">Finished Product</td><td class="nopading">Schneider/Fuji/Yaskawa</td></tr>
                    <tr><td class="nopading">17</td><td class="nopading">Electrical Cabinet</td><td class="nopading">SS304</td><td class="nopading">FLOWREX</td></tr>
                </tbody>
            </table>                        
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=7/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 7-->

    <!-- Halaman 8 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=8 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">E. Scope of Supply</h5>

            <table class="table table-bordered">
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
                        <td rowspan="3">1</td><td class="ps-0 fw-bold">{{__('Equipment MPS')}}</td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td class="p-0">Panel control (only for MPS)</td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0">MPS</td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                        <td class="p-0"></td>
                    </tr>
                    
                    <tr>
                        <td rowspan="4">2</td><td class="ps-0 fw-bold">{{__('Chemical Dosing')}}</td><td></td><td></td><td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0" class="description">Dosing Pump and skid</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Dosing Pump') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Dosing Pump') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0" class="description">Agitator + Chemical Tank</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Agitator + Chemical Tank') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Agitator + Chemical Tank') ? '√' : '' }}</td>
                        <td class="p-0">For type 101-303</td>
                    </tr>
                    <tr>
                        <td class="p-0" class="description">APP (Automatic Polymer Preparation)</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'APP (Automatic Polymer Preparation)') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'APP (Automatic Polymer Preparation)') ? '√' : '' }}</td>
                        <td class="p-0">For type 401-403</td>
                    </tr>
                    <tr>
                        <td rowspan="4">3</td><td class="ps-0 fw-bold">{{__('Tank')}}</td><td></td><td></td><td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Chemical Tank</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Sludge Tank</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Filtrat Tank</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="3">4</td><td class="ps-0 fw-bold">{{__('Pump')}}</td><td></td><td></td><td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Feed Pump</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Filtrat Pump</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Pump (Feed Pump & Filtrat Pump)') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="5">5</td><td class="ps-0 fw-bold">{{__('Interconnection')}}</td><td></td><td></td><td>If Neccessary</td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Cable from Main Panel to Local Panel</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Interconnection Pipe from Feed Pump to Equipment</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Clean water washing tube connection</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Chemical Connection</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="4">6</td><td class="ps-0 fw-bold">{{__('Civil and Structural Works')}}</td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Foundation</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Civil & Structural Work - Foundation') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Civil & Structural Work - Foundation') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Shelter</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Maintenance platform and safety handrails</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    
                    <tr>
                        <td rowspan="4">7</td><td class="ps-0 fw-bold">{{__('Testing and commissioning')}}</td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Chemical during commissioning</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Chemical') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Chemical') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Sufficient water and electricity during the commissioning</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Offline training</td>
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Offline Training') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Testing & Commissioning - Offline Training') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="3">8</td><td class="ps-0 fw-bold">{{__('Document')}}</td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Installation Manual Book</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Packing list</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>
                </tbody>
                
            </table>
        </div>
        <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=8/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 8-->


    <!-- Halaman 9 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=9 :countpage=11/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <table class="table table-bordered">
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
                        <td rowspan="2">9</td><td class="ps-0 fw-bold">{{__('Authority Submission')}}</td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Any/All Insurance and Taxes Not Specially Hughlighted/Mentioned in This document</td>
                        <td class="p-0"></td>
                        <td class="p-0 text-center">√</td>
                        <td class="p-0"></td>
                    </tr>

                    <tr>
                        <td rowspan="4">10</td><td class="ps-0 fw-bold">{{__('Others')}}</td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td class="p-0 description">Shipping to onsite</td>
                        <td class="p-0 text-center">{{ $orderfind->shipping?->use_shipping_to_onsite ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->shipping?->use_shipping_to_onsite ? '√' : '' }}</td>
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
                        <td class="p-0 text-center">{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Supervision of Installation') ? '√' : '' }}</td>
                        <td class="p-0 text-center">{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Supervision of Installation') ? '√' : '' }}</td>
                        <td class="p-0"></td>
                    </tr>
                </tbody>
                
            </table>

            <h5 class="mt-5">F. Term and Condition</h5>
            <table class="table table-bordered">
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
                        @if($orderfind->termpayment)
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
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=9/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 9-->

    <!-- Halaman 10 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=10 :countpage=11/>
        <!-- End Header -->

       <!-- Konten Utama -->
       <div class="content">
           <h5 class="mt-5">G. Drawing of MPS</h5>

           {{-- <div class="row"> --}}

               <div class="row text-center">
                   <div class="col-12">
                       <img src="{{ url('/quot/mps/drawing-mps.webp') }} " alt="Gambar 1" class="img-fluid" style="width: 80%;">
                   </div>
               </div>
           {{-- </div> --}}
       </div>
       <!-- End Konten Utama -->

       <!-- Footer -->
       <x-penawaran-pdf-footer :orderfind="$orderfind" :page=10/>
       <!-- End Footer -->
   </div>
   <!-- End Halaman 10-->

    <!-- Halaman 11 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=11 :countpage=11/>
        <!-- End Header -->

            <!-- Konten Utama -->
            <div class="content">
                <h5 class="mt-5">H. Project References</h5>

                {{-- <div class="row"> --}}
                    <div class="row text-center">
                        <div class="col-12 mb-2">
                            <img src="{{ url('/quot/mps/produk-mps.webp') }} " alt="Gambar 1" class="img-fluid" style="width: 85%;">
                        </div>
                    
                        <div class="col-6 mb-2">
                            <img src="{{ url('/quot/mps/example-mps.webp') }}" alt="Gambar 3" class="img-fluid" style="width: 70%;">
                        </div>
                        <div class="col-6 mb-2">
                            <img src="{{ url('/quot/mps/sample-mps.webp') }}" alt="Gambar 2" class="img-fluid" style="width: 70%;">
                        </div>

                        <div class="col-12">
                            <img src="{{ url('/quot/mps/qr-code-mps.webp') }}" alt="Gambar 3" class="img-fluid" style="width: 20%;">
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            <!-- End Konten Utama -->

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=11/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 11-->

    <!-- Back Cover page dengan gambar -->
    <div class="cover-page">
        <img src="{{ url('/quot/fas/back-cover.webp') }}" alt="Cover Image">
    </div>
    <!-- End Back Cover page dengan gambar -->

    <!-- Tombol Print -->
    <button onclick="window.print();"
        class="print-hidden btn btn-info fw-bold btn-print"
        style="font-size: 20px; padding: 15px 30px;">
        <span style="font-size: 28px; margin-right: 8px;">&#x1f5b6;</span>
        PRINT
    </button>

</body>

</html>
