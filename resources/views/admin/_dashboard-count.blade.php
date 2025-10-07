<header>
    <style>
        /* Range di tengah */
        .daterangepicker td.in-range {
            background-color: rgba(46, 130, 50, 0.2) !important;
            color: #000 !important;
        }

        /* Hari awal range */
        .daterangepicker td.start-date,
        .daterangepicker td.start-date.available {
            background-color: rgba(46, 130, 50, 0.7) !important;
            color: #fff !important;
            border-radius: 0 !important;
        }

        /* Hari akhir range */
        .daterangepicker td.end-date,
        .daterangepicker td.end-date.available {
            background-color: rgba(46, 130, 50, 0.7) !important;
            color: #fff !important;
            border-radius: 0 !important;
        }

        /* Active (jika hanya 1 tanggal dipilih) */
        .daterangepicker td.active {
            background-color: rgba(46, 130, 50, 0.9) !important;
            color: #fff !important;
        }

        /* Header bulan */
        .daterangepicker .drp-calendar .calendar-table th.month {
            background-color: #fff !important;
            color: #000 !important;
        }

        /* Header hari */
        .daterangepicker .calendar-table thead th {
            background-color: #fff !important;
            color: #000 !important;
        }
    </style>
</header>
<!--begin::Row Data Range-->
<div class="col-xl-8 mb-3 mb-xl-5">
    <div class="card card-flush h-xl-100">
        <div class="card-header py-2">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">Filter Date</span>
            </h3>

            <div class="card-toolbar mt-4">
                <form id="filterForm" method="GET" action="{{ route('admin.dashboard') }}">
                    <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">

                    <!--begin::Daterangepicker-->
                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                        class="btn btn-sm btn-light d-flex align-items-center px-4">
                        <div class="text-gray-600 fw-bold">
                            @if(request('start_date') && request('end_date'))
                                {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                            @else
                                Pilih rentang tanggal...
                            @endif
                        </div>
                        <i class="ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0"></i>
                    </div>
                    <!--end::Daterangepicker-->
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Row Data Range-->

<!-- Begin:: Users Status -->
    <div class="col-xl-6 mb-3 mb-xl-5">
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">User Status</span>
                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Jumlah berdasarkan status</span>
                </h3>

                <h5 class="text-end">Total: {{ $totalUsers }}</h5>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed gs-0 gy-4">
                        <thead style="background-color: white">
                            <tr class="fs-7 fw-bold text-gray-500">
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $maxValue = !empty($usersStatusCount) ? max($usersStatusCount) : 0; @endphp
                            @foreach($usersStatusCount as $status => $jumlah)
                                @php
                                    $width = $maxValue > 0 ? number_format(($jumlah / $maxValue) * 100, 2) : 0;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('alluser.index', [
                                                'status' => $status,
                                                'start_date' => request('start_date'),
                                                'end_date'   => request('end_date')
                                            ]) }}" 
                                            class="text-primary fw-bold">
                                            {{ Str::ucfirst($status) }}
                                        </a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">{{ $jumlah }}</span>
                                        <a href="{{ route('alluser.index', [
                                                'status' => $status,
                                                'start_date' => request('start_date'),
                                                'end_date'   => request('end_date')
                                            ]) }}">
                                            <div class="progress w-100px">
                                                <div class="progress-bar bg-info" style="height:12px; width: {{ $width }}%"></div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- End:: Users Status -->

<!-- Begin:: Quotation Status -->
    <div class="col-xl-6 mb-5 mb-xl-5">
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Quotation Status</span>
                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Jumlah berdasarkan status</span>
                </h3>

                <h5 class="text-end">Total: {{ $totalRFQ }}</h5>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed gs-0 gy-4">
                        <thead style="background-color: white">
                            <tr class="fs-7 fw-bold text-gray-500">
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $maxValue = !empty($rfqStatusCount) ? max($rfqStatusCount) : 0; @endphp
                            @foreach($rfqStatusCount as $status => $jumlah)
                                @php
                                    $width = $maxValue > 0 ? number_format(($jumlah / $maxValue) * 100, 2) : 0;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('equipment.order.index', [
                                                'status' => $status,
                                                'start_date' => request('start_date'),
                                                'end_date'   => request('end_date')
                                            ]) }}" 
                                            class="text-primary fw-bold">
                                            {{ Str::ucfirst($status) }}
                                        </a>
                                    </td>
                                    {{-- <td>{{ Str::ucfirst($status) }}</td> --}}
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">{{ $jumlah }}</span>
                                        <a href="{{ route('equipment.order.index', [
                                                'status' => $status,
                                                'start_date' => request('start_date'),
                                                'end_date'   => request('end_date')
                                            ]) }}" >
                                            <div class="progress w-100px">
                                                <div class="progress-bar bg-primary" style="height:12px; width: {{ $width }}%"></div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- End:: Quotation Status -->