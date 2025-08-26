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
            /* Sesuaikan jika diperlukan */
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
            /* Sesuaikan jarak dari bawah halaman */
            /* left: 0; */
            /* width: 100%; */
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
        <img src="{{ url('/quot/fas/cover-fas.webp') }}" alt="Cover Image">
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=2 :countpage=10/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5 text-center">
                DOCUMENT REVISION RECORD
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header fw-bold text-center">
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=3 :countpage=10/>
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
                    <span><u>{{$orderfind->pic->job_title}}</u></span>
                    <br/>
                    <span>Water Business Unit</span>

                    <br/>
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=4 :countpage=10/>
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
                        <li><span>A. Quotation Summary</span><div class="line"></div><span class="page-number">5</span></li>
                        <li><span>B. Aerator Dimension</span><div class="line"></div><span class="page-number">6</span></li>
                        <li><span>C. Scope Of Supply</span><div class="line"></div><span class="page-number">6</span></li>
                        <li><span>D. Tehnical Data Sheet</span><div class="line"></div><span class="page-number">7</span></li>
                        <li><span>E. Term And Condition</span><div class="line"></div><span class="page-number">8</span></li>
                        <li><span>F. Product</span><div class="line"></div><span class="page-number">9</span></li>
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=5 :countpage=10/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">A. Quotation Summary</h5>

            <p>The following is the price for <strong>{{ $orderfind->items->first()->product->nama_produk }} - {{ $productMainSpecification->type_name}}</strong>. Please see item specific pages for more details.</p>
            
            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header fw-bold text-center">
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
                            <td colspan="4" class="text-end"><strong>Harga Produk Tambahan & Biaya Pengiriman *</strong></td>
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
                            <td colspan="4" class="text-end"><strong>Grand Total (Exclude PPN) **</strong></td>
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

        <!-- Footer -->
        <x-penawaran-pdf-footer :orderfind="$orderfind" :page=5/>
        <!-- End Footer -->
    </div>
    <!-- End Halaman 5-->

    <!-- Halaman 6 -->
    <div class="page mx-15">
        <!-- Header -->
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=6 :countpage=10/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">B. Aerator Dimension</h5>
            <div class="row text-center">
                <div class="col-12 mb-3">
                    <img src="{{ url('/quot/fas/sketsa-dimensi-aerator.webp') }}" alt="Gambar 1" class="img-fluid" style="width: 55%;">
                </div>
                <div class="col-12">
                    <img src="{{ url('/quot/fas/dimensi-aerator.webp') }}" alt="Gambar 2" class="img-fluid" style="width: 55%;">
                </div>
            </div>                
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=7 :countpage=10/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">C. Scope of Supply</h5>

            <table class="table table-bordered">
                <thead>
                    <tr class="highlight-header fw-bold text-center">
                        <th>No</th>
                        <th>Components</th>
                        <th>Grinviro</th>
                        <th>Client</th>
                        <th>Description  </th>
                    </tr>
                </thead>


                <tbody>
                    <tr>
                        <td class="nopading">1</td>
                        <td class="nopading">Equipment Aerator</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Panel Control (for Aerator)</td>
                        <td>√</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Aerator</td>
                        <td>√</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="nopading">2</td>
                        <td class="nopading">Interconnection</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Cable from Main Panel to Local Panel</td>
                        <td></td>
                        <td>√</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Cable from Local Panel to Aerator</td>
                        <td></td>
                        <td>√</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="nopading">3</td>
                        <td class="nopading">Ropes</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Ropes for Aerator</td>
                        <td>√</td>
                        <td></td>
                        <td>Only 100m</td>
                    </tr>
                    <tr>
                        <td class="nopading">4</td>
                        <td class="nopading">Testing and Commissioning</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Commissioning Cost</td>
                        <td>{{ $orderfind->items->contains('productadd.nama_produk_tambahan',  'Commissioning Cost') ? '√' : '' }}</td>
                        <td>{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Commissioning Cost') ? '√' : '' }}</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Sufficient water and electricity during the commissioning</td>
                        <td></td>
                        <td>√</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Site Supervision</td>
                        <td>{{ $orderfind->items->contains('productadd.nama_produk_tambahan', 'Site Supervision') ? '√' : '' }}</td>
                        <td>{{ !$orderfind->items->contains('productadd.nama_produk_tambahan', 'Site Supervision') ? '√' : '' }}</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td class="nopading">5</td>
                        <td class="nopading">Document</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Installation Manual Book</td>
                        <td>√</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Packing List</td>
                        <td>√</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="nopading">6</td>
                        <td class="nopading">Authority Submission</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Any/All Insurance and Taxes Not Specially Hugh lighted/Mentioned in This document</td>
                        <td></td>
                        <td>√</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="nopading">7</td>
                        <td class="nopading">Others</td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                        <td class="nopading"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Shipping to Onsite</td>
                        <td>{{ $orderfind->shipping?->use_shipping_to_onsite ? '√' : '' }}</td>
                        <td>{{ !$orderfind->shipping?->use_shipping_to_onsite ? '√' : '' }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Loading and unloading material/Equipment to laydown area</td>
                        <td></td>
                        <td>√</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="description">Installation Cost</td>
                        <td></td>
                        <td>√</td>
                        <td></td>
                    </tr>
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=8 :countpage=10/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">D. Technical Data Sheet</h5>

            <table class="table table-bordered">
                <tr>
                    <td class="align-middle text-center no-border-right p-5" rowspan="2">
                        <x-app-logo alt="Logo" class="h-30px mb-4"></x-app-logo>
                    </td>
                    <td class="align-middle no-border-left" rowspan="2">
                        <div class="company-name">
                            PT GUNA HIJAU INOVASI
                        </div>
                        <div class="sub-title">
                            Water &amp; Wastewater Management
                        </div>
                    </td>
                </tr>

                <tr class="text-center">
                    <td colspan="4" class="p-5">
                        Floating Suface Aerator </br> Techical Specification Sheet
                    </td>
                </tr>

                <tr class="text-center">
                    <td colspan="2" rowspan="2" class="p-5">
                        Technical Data Sheet,</br>{{ $productMainSpecification->type_name}}
                    </td>
                    <td class="text-end">
                        Sheet
                    </td>
                    <td>
                        Rev
                    </td>
                    <td>
                        Mfc By
                    </td>
                    <td>
                        Checked By
                    </td>
                </tr>
                <tr>
                    <td class="text-end">
                        1 0f 1
                    </td>
                    <td>
                        0
                    </td>
                    <td>
                        GHI
                    </td>
                    <td>
                        GHI
                    </td>
                </tr>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center text-bold" colspan="2">
                            Operating Data
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold">
                            Model
                        </td>
                        <td>
                            {{ $orderfind->items->first()->product->nama_produk }} - {{ $productMainSpecification->type_name}}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Standart O2
                            {{-- <sub>
                                2
                            </sub> --}}
                            Transfer Rate (SOTR)
                        </td>
                        <td class="text-bold">
                        {{ $productMainSpecification->aerator_sotr}} kg O<sub>2</sub> /hour (Clean Water – Standart Condition)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Depth in Meter of Complete Mixing
                        </td>
                        <td>
                            {{ $productMainSpecification->aerator_d}} m
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Motor Power
                        </td>
                        <td>
                            {{ $productMainSpecification->power_hp}} hp / {{ $productMainSpecification->power_kw}} Kw/ 1450 rpm/ 380–460 V, 50 Hz
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center text-bold" colspan="2">
                            Aerator Material
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold">
                            Water Intake Cone
                        </td>
                        <td>
                            SUS 304
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">Rain Cover</td>
                        @if (in_array($productMainSpecification->type_name, ['FAS 3100', 'FAS 320', 'FAS 310', 'FAS 305']))
                            <td>SUS 304</td>
                        @else
                            <td>FRP with PU Filling</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Water Guide Panel
                        </td>
                        <td>
                            SUS 304
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Floater
                        </td>
                        <td>
                            FRP with PU Filling
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Shaft
                        </td>
                        <td>
                            SUS 304
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">
                            Impeller
                        </td>
                        <td>
                            SUS 304
                        </td>
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=9 :countpage=10/>
        <!-- End Header -->

        <!-- Konten Utama -->
        <div class="content">
            <h5 class="mt-5">E. Term and Condition</h5>
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
        <x-penawaran-pdf-header :orderfind="$orderfind" :page=10 :countpage=10/>
        <!-- End Header -->

       <!-- Konten Utama -->
       <div class="content">
           <h5 class="mt-5">F. Product</h5>

           {{-- <div class="row"> --}}

               <div class="row text-center">
                   <div class="col-12 mb-3">
                       <img src="{{ url('/quot/fas/fas-surface-aerator.webp') }} " alt="Gambar 1" class="img-fluid" style="width: 80%;">
                   </div>
                   <div class="col-12 mb-3">
                       <img src="{{ url('/quot/fas/fas-surface-aerator-two.webp') }}" alt="Gambar 2" class="img-fluid" style="width: 80%;">
                   </div>
                   <div class="col-12">
                       <img src="{{ url('/quot/fas/qr-code-fas.webp') }}" alt="Gambar 3" class="img-fluid" style="width: 20%;">
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
