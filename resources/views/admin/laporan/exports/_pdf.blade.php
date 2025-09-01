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
                                Laporan Client
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
                                <span class="text-muted fw-bold fw-italic fs-5"><u>PIC</u></span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Nama PIC</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->users->first()->name ?? '-' }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Email PIC</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->users->first()->email ?? '-' }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">No. Telpon PIC</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ isset($data->users->first()->phone) ? '0'.substr($data->users->first()->phone, 2) : '-' }}</td>
                                    </tr>
                                </span>
                            </div>
    
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted fw-bold fw-italic fs-5"><u>CLIENT</u></span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Nama Client</span></td>
                                        <td><span class="text-muted">:</span></td>
                                        <td>{{ $data->nama }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Jabatan</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->jabatan }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">No. Telpon</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->telpon }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Email</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Institusi</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->institusi }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Lokasi</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->lokasi_institusi }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Bidang</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->bidang_institusi }}</td>
                                    </tr>
                                </span>
                                <span class="fs-6">
                                    <tr>
                                        <td><span class="text-muted fw-bold mr-2">Detail</span></td>
                                        <td><span class="text-muted mr-2">:</span></td>
                                        <td>{{ $data->detail_institusi }}</td>
                                    </tr>
                                </span>
                                
                            </div>
                        </div>
                        <!--begin:Order summary-->

                        <!--begin::Separator-->
                        <div class="separator mt-2 mb-2"></div>
                        <!--begin::Separator-->

                        <table class="three-columns">
                            <tr>
                                <td class="cell label">Tanggal Ke Exhibition :</td>
                                <td class="cell value">
                                    <ul>
                                        @foreach ($data->tgl_hadir as $item)
                                        <li class="fs-7">{{$item}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell label">Kebutuhan :</td>
                                <td class="cell value">
                                    <ul>
                                        @foreach ($data->kebutuhan as $item)
                                        <li class="fs-7 text-uppercase">{{$item}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell label">Kebutuhan Lainnya :</td>
                                <td class="cell value fs-6">
                                    @if ($data->kebutuhan_lain != null)
                                        {{ $data->kebutuhan_lain }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="cell label">Next To Do :</td>
                                <td class="cell value fs-7">
                                    @if (isset($data->reportPresensis->first()->detailReport))
                                        <span class="badge badge-light-info my-1 me-2 text-uppercase">{{ $data->reportPresensis->first()->detailReport->next_todo }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>



                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered fs-7" id="kt_table_users">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>Hasil Diskusi</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fs-7 fw-semibold">
                                <tr>
                                    <td>
                                        @if (isset($data->reportPresensis->first()->detailReport))
                                             {!! $data->reportPresensis->first()->detailReport->diskusi !!}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                
                            </tbody>
                            <!--end::Table body-->
                        </table>
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


    <div style="padding:5px;background-color:#f5e3c4;width:100%;margin-top:40px">Cetak oleh:
        <i>{{ Auth::user()->name }}
            {{ auth()->user()->userable ? '(' . auth()->user()->userable->type . ')' : '' }}</i>, pada
        <i>{{  App\Helpers\Helper::dateFormat(now(), 'd F Y') }}</i>
    </div>
    <button onclick="window.print();"
        class="print-hidden btn btn-info fw-bold btn-print"
        style="font-size: 20px; padding: 15px 30px;">
        <span style="font-size: 28px; margin-right: 8px;">&#x1f5b6;</span>
        PRINT
    </button>
</body>

</html>
