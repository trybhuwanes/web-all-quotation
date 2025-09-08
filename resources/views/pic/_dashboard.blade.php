<!--begin::Row-->
<div class="row gy-5 gx-xl-10 mt-1">

        <!--begin::Col-->
        <div class="col-xl-8 mb-5 mb-xl-10">
            <!--begin::Chart widget 32-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7 mb-3">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Total Sales Anda</span>
                        
                    </h3>
                    <!--end::Title-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">      
                        <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                        <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">
                            <!--begin::Display range-->
                            <div class="text-gray-600 fw-bold">
                                Loading date range...
                            </div>
                            <!--end::Display range-->

                            <i class="ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>       
                        </div>  
                        <!--end::Daterangepicker-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between pb-5 px-0">

                    <!--begin::Tab Content-->
                    <div class="tab-content ps-4 pe-6">
                                        <!--begin::Tap pane-->
                            <div class="tab-pane fade active show" id="kt_charts_widget_32_tab_content_1">
                                <!--begin::Chart-->
                                <div id="kt_charts_widget_1" class="min-h-auto" style="height: 375px"></div>
                                <!--end::Chart-->
                            </div>
                        
                    </div>
                    <!--end::Tab Content-->        
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Chart widget 32-->
        </div>
        <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xl-4 mb-xl-10">
        <!--begin::Engage widget 3-->
        <div class="card bg-primary h-md-100" data-bs-theme="light"> 
            <!--begin::Body-->
            <div class="card-body d-flex flex-column pt-6 pb-14">  
                <!--begin::Heading-->
                <div class="m-0">
                    <!--begin::Title-->
                    <h1 class="fw-semibold text-white text-center lh-lg mb-9">
                        <span class="fw-bolder">Pengguna Ditangani <br> {{$totalCustomers}}</span>
                    </h1>
                    <!--end::Title-->  
                    
                    <!--begin::Illustration-->
                    <div 
                        class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" 
                        style="background-image: url('/template/assets/media/logos/maskot-grinviro.webp')">
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Heading-->

                <!--begin::Links-->
                <div class="text-center"> 
                    

                    <!--begin::Link-->
                    <a class="btn btn-sm bg-white btn-color-gray-800 me-2"  href="{{ route('order-pic.index') }}" >
                        Lihat Data
                    </a>
                    <!--end::Link-->
                </div>
                <!--end::Links-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 3--> 
    </div>
    <!--end::Col-->

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
                    <span class="card-label fw-bold fs-3 mb-1">Sales Anda</span>
                </h3>

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center gap-2">

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

<!-- Modal -->
<div class="modal fade" id="ordersModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Daftar Order - <span id="modalDate"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="ordersList">Loading...</div>
      </div>
    </div>
  </div>
</div>






@push('js')
<!--begin::Vendors Javascript(used by this page)-->
<script>
    "use strict";
    var KTChartsDashboard = function() {
        return {
            init: function() {
            this.initChart();
            this.initRevenueChart(); // Initialize revenue and target chart
            this.bindEvents();
        },

        initChart: function() {
            let Url = route('pic.dashboard.getsales');
            axios.get(Url)
                .then(response => {
                    this.totalHandles = response.data.map(item => ({
                        date: item.date,
                        value: item.value
                    }));
                    this.renderChart(this.totalHandles);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },

        initRevenueChart:function(year = new Date().getFullYear()) {
            let revenueUrl = route('pic.dashboard.getrevenuepic', { year: year });
            
            axios.get(revenueUrl).then(response => {
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
                        colors: ["#F1416CD9", "#36A2EB", "#0B7A12"], 
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

            renderChart: function(totalHandles) {
                if (this.chartInstance) {
                    this.chartInstance.destroy();
                }
                
                var chartElement = document.querySelector("#kt_charts_widget_1");
                var self = this;

                var chartOptions = {
                    series: [{
                        name: "Total Sales",
                        data: totalHandles.map(handle => handle.value)
                    }],
                    chart: {
                        fontFamily: "inherit",
                        type: "bar",
                        height: 350,
                        toolbar: { show: false },
                        events: {
                            dataPointSelection: function(event, chartContext, config) {
                                let index = config.dataPointIndex; 
                                let clickedDate = totalHandles[index].date;

                                // ubah judul modal
                                document.getElementById("modalDate").innerText = clickedDate;

                                // loading state
                                document.getElementById("ordersList").innerHTML = "Loading...";

                                // ambil data via AJAX
                                axios.get(route('orders.byDate', { date: clickedDate }))
                                    .then(response => {
                                        document.getElementById("ordersList").innerHTML = response.data.html;
                                        let modal = new bootstrap.Modal(document.getElementById('ordersModal'));
                                        modal.show();
                                    })
                                    .catch(error => {
                                        console.error(error);
                                        document.getElementById("ordersList").innerHTML = "<p class='text-danger'>Gagal memuat data</p>";
                                        let modal = new bootstrap.Modal(document.getElementById('ordersModal'));
                                        modal.show();
                                    });
                            }
                        }

                    },
                    colors: ['#075E0C'],
                    xaxis: {
                        categories: totalHandles.map(handle => handle.date),
                        title: { text: 'Date' }
                    },
                    yaxis: {
                        title: { text: 'Jumlah' },
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
                        }
                    },
                    title: {
                        text: 'Total Sales',
                        align: 'center'
                    }
                };

                this.chartInstance = new ApexCharts(chartElement, chartOptions);
                this.chartInstance.render();
            },

            bindEvents: function() {
                var self = this;
                document.querySelectorAll('.ranges li').forEach(item => {
                    item.addEventListener('click', function(event) {
                        const rangeKey = event.target.getAttribute('data-range-key');
                        if (rangeKey === 'Today') {
                            self.filterData('today');
                        } else if (rangeKey === 'This Month') {
                            self.filterData('month');
                        } else if (rangeKey === 'This Year') {
                            self.filterData('year');
                        }
                    });
                });

                document.querySelector('.drp-buttons .applyBtn').addEventListener('click', function() {
                    const dateRange = document.querySelector('.drp-selected').innerText;
                    let [startDate, endDate] = dateRange.split(' - ');

                    const formatDate = (dateString) => {
                        const [day, month, year] = dateString.split('/');
                        return `${year}-${month}-${day}`;
                    };

                    // Konversi startDate dan endDate ke format yang diinginkan
                    startDate = formatDate(startDate.trim());
                    endDate = formatDate(endDate.trim());
                    self.filterData('custom', startDate, endDate);
                });

                // 👇 listener buat select tahun
                document.getElementById("yearSelect").addEventListener("change", function() {
                    const selectedYear = this.value;
                    self.initRevenueChart(selectedYear);
                });
            },

            filterData: function(range, startDate = null, endDate = null) {
            var filteredHandles = [];

            // Mendapatkan tanggal saat ini
            const today = new Date().toISOString().split('T')[0];
            const startOfWeek = new Date();
            startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay()); // Mulai minggu ini
            const startOfMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().split('T')[0];
            const startOfYear = new Date(new Date().getFullYear(), 0, 1).toISOString().split('T')[0]; // Tanggal awal tahun ini

            if (range === 'today') {
                // Ambil data hanya untuk hari ini
                filteredHandles = this.totalHandles.filter(handle => handle.date === today);
            } else if (range === 'week') {
                // Ambil data untuk minggu ini
                filteredHandles = this.totalHandles.filter(handle => new Date(handle.date) >= startOfWeek);
            } else if (range === 'month') {
                // Ambil data untuk bulan ini
                filteredHandles = this.totalHandles.filter(handle => handle.date >= startOfMonth);
            } else if (range === 'year') {
                // Ambil data untuk tahun ini
                filteredHandles = this.totalHandles.filter(handle => handle.date >= startOfYear);
            } else if (range === 'custom' && startDate && endDate) {
                const start = startDate;
                const end = endDate;

                filteredHandles = this.totalHandles.filter(handle => {
                    const handleDate = handle.date;
                    return handleDate >= start && handleDate <= end;
                });
            }

            this.renderChart(filteredHandles);
        },

        };
    }();
    
    document.addEventListener('DOMContentLoaded', function() {
        KTChartsDashboard.init();
    });
</script>
    
    
@endpush