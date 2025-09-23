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


<!--begin::Row Penjualan PIC-->
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
                    <select id="picSelect" class="form-select fw-bold form-select-sm" data-placehoder="Pilih PIC">
                        <option value="">Pilih PIC</option>
                        @foreach($piclist as $pic)
                            <option value="{{ $pic->id }}" {{ $pic->id == 4 ? 'selected' : '' }}>
                                {{ $pic->name }}
                            </option>
                        @endforeach        
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
var KTChartsDashboard = function () {
    return {
        init: function () {
            this.initOrderStatusChart();
            this.initRevenueChart(); // default load
            this.bindEvents();
        },

        // === Order Status Chart ===
        initOrderStatusChart: function () {
            let Url = route("admin.dashboard.getorderstatus", {
                start_date: new URLSearchParams(window.location.search).get("start_date"),
                end_date: new URLSearchParams(window.location.search).get("end_date"),
            });

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
        initRevenueChart: function (picId = 4) {
            let params = {
                pic_id: picId,
                start_date: new URLSearchParams(window.location.search).get("start_date"),
                end_date: new URLSearchParams(window.location.search).get("end_date"),
            };

            let revenueUrl = route("admin.dashboard.getrevenuepic", params);

            axios.get(revenueUrl)
                .then(response => {
                    let targetData = response.data.map(item => item.target);
                    let prospekData = response.data.map(item => item.prospek);
                    let goalData = response.data.map(item => item.goal);
                    let months = response.data.map(item => item.month);

                    this.renderRevenueChart(targetData, prospekData, goalData, months);
                })
                .catch(error => {
                    console.error("Error fetching revenue data:", error);
                });
        },

        renderRevenueChart: function (targetData, prospekData, goalData, months) {
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
                        toolbar: { show: false },
                        events: {
                            dataPointSelection: function (event, chartContext, config) {
                                let index = config.dataPointIndex;
                                let clickedMonth = months[index];
                                let selectedYear = new Date().getFullYear(); // atau ambil dari filter tahun kalau ada

                                // Format ke YYYY-MM
                                let monthIndex = moment(clickedMonth, "MMMM").format("MM"); 
                                let formattedMonth = selectedYear + "-" + monthIndex;

                                // Ambil PIC ID terpilih
                                let selectedPicId = document.getElementById("picSelect").value || 4;

                                // Ubah judul modal
                                document.getElementById("modalDate").innerText = clickedMonth;

                                // Tampilkan loading state
                                document.getElementById("ordersList").innerHTML = "Loading...";

                                // Request ke backend (pakai route baru khusus admin)
                                axios.get(route("admin.dashboard.orders.byDate", {
                                    month: formattedMonth,
                                    pic_id: selectedPicId
                                }))
                                .then(response => {
                                    document.getElementById("ordersList").innerHTML = response.data.html;
                                    new bootstrap.Modal(document.getElementById("ordersModal")).show();
                                })
                                .catch(error => {
                                    console.error(error);
                                    document.getElementById("ordersList").innerHTML =
                                        "<p class='text-danger'>Gagal memuat data</p>";
                                    new bootstrap.Modal(document.getElementById("ordersModal")).show();
                                });
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "30%",
                            borderRadius: 4,
                            dataLabels: { position: "top" }
                        }
                    },
                    colors: ["#FFC700D9", "#36A2EB", "#0B7A12"],
                    xaxis: {
                        categories: months,
                        title: { text: "Bulan" }
                    },
                    yaxis: {
                        min: 0,
                        labels: {
                            formatter: function (value) {
                                return "Rp " + value.toLocaleString("id-ID");
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (value) {
                            return "Rp " + value.toLocaleString("id-ID");
                        },
                        style: { fontSize: "10px", colors: ["#000"] }
                    },
                    tooltip: {
                        y: {
                            formatter: function (value) {
                                return "Rp " + value.toLocaleString("id-ID");
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

        renderOrderStatusChart: function (orderData) {
            if (!Array.isArray(orderData)) {
                console.error("Order data bukan array:", orderData);
                return;
            }

            let chartElement = document.getElementById("kt_chart_sale_product");
            if (chartElement) {
                let chartOptions = {
                    series: [
                        { name: "Pending", data: orderData.map(item => item.pending) },
                        { name: "Submission", data: orderData.map(item => item.submission) },
                        { name: "Processing", data: orderData.map(item => item.processing) },
                        { name: "Completed", data: orderData.map(item => item.completed) },
                        { name: "Cancelled", data: orderData.map(item => item.cancelled) }
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
        },

        bindEvents: function () {
            // Inisialisasi daterangepicker dengan nilai dari hidden input
            let startVal = document.getElementById("start_date").value;
            let endVal   = document.getElementById("end_date").value;

            let start = startVal ? moment(startVal, "YYYY-MM-DD") : moment().startOf("month");
            let end   = endVal ? moment(endVal, "YYYY-MM-DD")   : moment().endOf("month");

            $('[data-kt-daterangepicker="true"]').daterangepicker({
                startDate: start,
                endDate: end,
                opens: "left",
                autoUpdateInput: true,
                linkedCalendars: false,
                locale: {
                    format: "DD/MM/YYYY",
                    separator: " - ",
                    applyLabel: "Apply",
                    cancelLabel: "Cancel",
                    customRangeLabel: "Custom Range",
                    daysOfWeek: ["Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
                    monthNames: [
                        "Januari","Februari","Maret","April","Mei","Juni",
                        "Juli","Agustus","September","Oktober","November","Desember"
                    ]
                },
                ranges: {
                    "Today": [moment(), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "This Year": [moment().startOf("year"), moment().endOf("year")]
                }
            }, function (start, end) {
                // Update hidden input
                $("#start_date").val(start.format("YYYY-MM-DD"));
                $("#end_date").val(end.format("YYYY-MM-DD"));

                // Update teks tampilan
                document.querySelector('[data-kt-daterangepicker="true"] .text-gray-600').innerText =
                    start.format("DD MMM YYYY") + " - " + end.format("DD MMM YYYY");

                // Submit form
                // document.getElementById("filterForm").submit();
                $("#filterForm").submit();
            });
        }
    };
}();

document.addEventListener("DOMContentLoaded", function () {
    KTChartsDashboard.init();

    let startVal = document.getElementById("start_date").value;
    let endVal   = document.getElementById("end_date").value;
    if (startVal && endVal) {
        let start = moment(startVal, "YYYY-MM-DD").format("DD MMM YYYY");
        let end   = moment(endVal, "YYYY-MM-DD").format("DD MMM YYYY");
        document.querySelector('[data-kt-daterangepicker="true"] .text-gray-600').innerText =
            start + " - " + end;
    }

    const picSelect = document.getElementById("picSelect");
    if (picSelect) {
        picSelect.addEventListener("change", function () {
            let selectedPicId = picSelect.value || 4;
            KTChartsDashboard.initRevenueChart(selectedPicId);
        });
    }
});
</script>
@endpush
