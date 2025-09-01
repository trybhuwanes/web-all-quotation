
    <!-- Users Status -->
    <div class="col-xl-6 mb-5 mb-xl-10">
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
                        <thead>
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
                                    <td>{{ Str::ucfirst($status) }}</td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">{{ $jumlah }}</span>
                                        <div class="progress w-100px">
                                            <div class="progress-bar bg-info" style="height:12px; width: {{ $width }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quotation Status -->
    <div class="col-xl-6 mb-5 mb-xl-10">
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
                        <thead>
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
                                    <td>{{ Str::ucfirst($status) }}</td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">{{ $jumlah }}</span>
                                        <div class="progress w-100px">
                                            <div class="progress-bar bg-primary" style="height:12px; width: {{ $width }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
