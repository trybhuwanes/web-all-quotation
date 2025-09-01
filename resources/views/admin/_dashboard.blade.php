<div class="row gy-5 gx-xl-10 mt-1">
{{-- <h1> & ORDER</h1> --}}
    @include('admin._dashboard-count')
</div>

<!--begin::Row Perbandingan penjualan produk-->
<div class="row g-5 gx-xl-10 mt-1">
    
    <div class="col-xl-12">
        <!--begin::Charts Widget 2-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Perbandingan Penjualan Produk</span>
                    {{-- <span class="text-muted fw-semibold fs-7">More than 500 new orders</span> --}}
                </h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Chart-->
                <div id="kt_chart_sale_product" style="height: 350px"></div>
                <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Charts Widget 2-->
    </div>
</div>
<!--end::Row-->


<!--begin::Row-->
<div class="row g-5 g-xl-8"> 
    <div class="col-xl-12">
        <!--begin::Charts Widget 2-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5 d-flex justify-content-between align-items-center">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">PIC Total Sales</span>
                </h3>

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center gap-2">
                    <select id="picSelect" class="form-select fw-bold form-select-sm">
                        @foreach($piclist as $pic)
                            <option value="{{ $pic->id }}" {{ $pic->id == 4 ? 'selected' : '' }}>
                                {{ $pic->name }}
                            </option>
                        @endforeach        
                    </select>

                    <select id="yearSelect" class="form-select fw-bold form-select-sm">
                        @php
                            $currentYear = date('Y');
                            $startYear = $currentYear - 5;
                        @endphp
                        @for($y = $startYear; $y <= $currentYear; $y++)
                            <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->


            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Chart-->
                <div id="kt_charts_pictotal_sales" style="height: 350px"></div>
                <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Charts Widget 2-->
    </div>
</div>
<!--end::Row-->




@push('js')
<!--begin::Vendors Javascript(used by this page)-->
<script>
"use strict";
var KTChartsDashboard = function() {
    return {
        init: function() {
            this.initOrderStatusChart();
            this.initRevenueChart(); // default pic_id = 4, year = tahun sekarang
        },

        initOrderStatusChart: function() {
            let Url = route('admin.dashboard.getorderstatus');

            axios.get(Url)
                .then(response => {
                    let rawData = Object.values(response.data);

                    this.orderStatusData = rawData.map(item => ({
                        product: item.product,
                        cancelled: item.cancelled || 0,
                        pending: item.pending || 0,
                        submission: item.submission || 0,
                        processing: item.processing || 0,
                        completed: item.completed || 0
                    }));

                    this.renderOrderStatusChart(this.orderStatusData);
                })
                .catch(error => {
                    console.error("Error fetching order status data:", error);
                });
        },

        // === Revenue Chart ===
        initRevenueChart: function(picId = 4, year = new Date().getFullYear()) {
            let revenueUrl = route('admin.dashboard.getrevenuepic', { pic_id: picId, year: year });

            axios.get(revenueUrl)
                .then(response => {
                    let targetData  = response.data.map(item => item.target);
                    let prospekData = response.data.map(item => item.prospek);
                    let goalData    = response.data.map(item => item.goal);
                    let months      = response.data.map(item => item.month);

                    this.renderRevenueChart(targetData, prospekData, goalData, months);
                })
                .catch(error => {
                    console.error('Error fetching revenue data:', error);
                });
        },

        renderRevenueChart: function(targetData, prospekData, goalData, months) {
            var chartElement = document.getElementById("kt_charts_pictotal_sales");
            if (chartElement) {
                var chartOptions = {
                    series: [
                        { name: "Target", data: targetData },
                        { name: "Prospek Omzet", data: prospekData },
                        { name: "Goal", data: goalData }
                    ],
                    chart: {
                        fontFamily: "inherit",
                        type: "bar",
                        height: 350,
                        toolbar: { show: false }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "30%",
                            borderRadius: 4,
                            dataLabels: { position: 'top' }
                        }
                    },
                    colors: ["#FFC700D9", "#36A2EB", "#0B7A12"], 
                    xaxis: {
                        categories: months,
                        title: { text: 'Bulan' }
                    },
                    yaxis: {
                        min: 0,
                        title: { text: '' },
                        labels: {
                            formatter: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        style: { fontSize: '10px', colors: ["#000"] },
                    },
                    fill: { opacity: 1 },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return "Rp " + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    legend: { position: "top" }
                };

                if (this.revenueChartInstance) {
                    this.revenueChartInstance.destroy();
                }

                this.revenueChartInstance = new ApexCharts(chartElement, chartOptions);
                this.revenueChartInstance.render();
            }
        },

        // === Order Status Chart ===
        renderOrderStatusChart: function(orderData) {
            if (!Array.isArray(orderData)) {
                console.error("Order data bukan array:", orderData);
                return;
            }

            let chartElement = document.getElementById("kt_chart_sale_product");
            if (chartElement) {
                let chartOptions = {
                    series: [
                        { name: "Pending",    data: orderData.map(item => item.pending) },
                        { name: "Submission", data: orderData.map(item => item.submission) },
                        { name: "Processing", data: orderData.map(item => item.processing) },
                        { name: "Completed",  data: orderData.map(item => item.completed) },
                        { name: "Cancelled",  data: orderData.map(item => item.cancelled) }
                    ],
                    chart: {
                        type: "bar",
                        height: 350,
                        toolbar: { show: false }
                    },
                    plotOptions: {
                        bar: { horizontal: false, columnWidth: "40%", borderRadius: 4 }
                    },
                    colors: ["#7239EAD9", "#3E97FFD9", "#FFC700D9", "#0B7A12", "#F1416CD9"],
                    xaxis: {
                        categories: orderData.map(item => item.product),
                        title: { text: "Produk" }
                    },
                    yaxis: {
                        title: { text: "Jumlah" }
                    },
                    dataLabels: { enabled: true },
                    legend: { position: "top" }
                };

                if (this.orderChartInstance) {
                    this.orderChartInstance.destroy();
                }

                this.orderChartInstance = new ApexCharts(chartElement, chartOptions);
                this.orderChartInstance.render();
            }
        }
    };
}();

// === DOM Ready ===
document.addEventListener('DOMContentLoaded', function() {
    // init default chart (pic_id = 4, year = sekarang)
    KTChartsDashboard.init();

    const picSelect  = document.getElementById('picSelect');
    const yearSelect = document.getElementById('yearSelect');

    function reloadRevenueChart() {
        let selectedPicId = picSelect.value || 4;
        let selectedYear  = yearSelect ? yearSelect.value : new Date().getFullYear();
        KTChartsDashboard.initRevenueChart(selectedPicId, selectedYear);
    }

    if (picSelect) {
        picSelect.addEventListener('change', reloadRevenueChart);
    }

    if (yearSelect) {
        yearSelect.addEventListener('change', reloadRevenueChart);
    }
});
</script>

    
@endpush
