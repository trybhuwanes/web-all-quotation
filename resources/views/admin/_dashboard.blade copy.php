<div class="row gy-5 gx-xl-10 mt-1">
<h1> & ORDER</h1>
    @include('admin._dashboard-count')
</div>

<!--begin::Row-->
<div class="row gy-5 gx-xl-10 mt-1">

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
                        <span class="fw-bolder">{{__('Manufacturing for Water, Wastewater & Energy')}}</span>
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
                    {{-- <a class="btn btn-sm bg-white btn-color-gray-800 me-2"  data-bs-target="#kt_modal_bidding" data-bs-toggle="modal" >
                        Show
                    </a> --}}
                    <!--end::Link-->

                    <!--begin::Link-->
                    {{-- <a class="btn btn-sm bg-white btn-color-white bg-opacity-20"  href="" >
                        Edit
                    </a> --}}
                    <!--end::Link-->
                </div>
                <!--end::Links-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 3--> 
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xl-8 mb-5 mb-xl-10">
            <!--begin::Chart widget 32-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7 mb-3">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">PIC Total Sales</span>
                        {{-- <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $totalGuest }} Total Tamu yang di Handle.</span> --}}
                    </h3>
                    <!--end::Title-->

                    <!--begin::Toolbar-->
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
                                <div id="kt_charts_widget_2" class="min-h-auto" style="height: 375px"></div>
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

</div>
<!--end::Row--> 


<!--begin::Row-->
<div class="row gy-5 gx-xl-10 mt-1">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        <!--begin::Chart widget 32-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-7 mb-3">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Total Sales</span>
                    {{-- <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $totalGuest }} Total Tamu yang di Handle.</span> --}}
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
                        {{-- <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_32_tab_content_2">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_32_chart_2" class="min-h-auto" style="height: 375px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_32_tab_content_3">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_32_chart_3" class="min-h-auto" style="height: 375px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tap pane--> --}}
                    
                </div>
                <!--end::Tab Content-->        
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Chart widget 32-->
</div>
<!--end::Col-->







@push('js')
<!--begin::Vendors Javascript(used by this page)-->
<script>
"use strict";
"use strict";
var KTChartsDashboard = function() {
    return {
        init: function() {
            this.initChart();
            this.initChart2(); // Inisialisasi chart kedua
            this.bindEvents();
        },

        initChart: function() {
            let Url = route('admin.dashboard.getsales');

            // Mengambil data dari database melalui Axios
            axios.get(Url)
                .then(response => {
                    // Transformasi data untuk chart pertama
                    this.totalHandles = response.data.map(item => ({
                        date: item.date, 
                        value: item.value 
                    }));
                    this.renderChart(this.totalHandles); // Inisialisasi chart pertama
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },

        initChart2: function() {
            let Url = route('admin.dashboard.getsalespic');

            // Mengambil data dari database melalui Axios untuk chart kedua
            axios.get(Url)
                .then(response => {
                    // Transformasi data untuk chart kedua
                    this.totalHandles2 = response.data.map(item => ({
                        date: item.date,
                        value: item.value
                    }));
                    this.renderChart2(this.totalHandles2); // Inisialisasi chart kedua
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },

        renderChart: function(totalHandles) {
            // Hancurkan chart yang ada jika sudah ada
            if (this.chartInstance) {
                this.chartInstance.destroy();
            }

            var o = document.querySelector("#kt_charts_widget_1");
            var d = {
                series: [{
                    name: "Total Sales",
                    data: totalHandles.map(handle => handle.value)
                }],
                chart: {
                    fontFamily: "inherit",
                    type: "bar",
                    height: 350,
                    toolbar: { show: false }
                },
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
            this.chartInstance = new ApexCharts(o, d);
            this.chartInstance.render();
        },

        renderChart2: function(totalHandles2) {
            // Hancurkan chart yang ada jika sudah ada
            if (this.chartInstance2) {
                this.chartInstance2.destroy();
            }

            var o = document.querySelector("#kt_charts_widget_2");
            var d = {
                series: [{
                    name: "Sales Tiap PIC",
                    data: totalHandles2.map(handle => handle.value)
                }],
                chart: {
                    fontFamily: "inherit",
                    type: "line", // Ubah tipe chart jika diinginkan
                    height: 375,
                    toolbar: { show: false }
                },
                xaxis: {
                    categories: totalHandles2.map(handle => handle.date),
                    title: { text: 'Nama PIC' }
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
                    text: 'Sales Setiap PIC',
                    align: 'center'
                }
            };
            this.chartInstance2 = new ApexCharts(o, d);
            this.chartInstance2.render();
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
