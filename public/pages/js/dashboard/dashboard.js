"use strict";

var KTChartsDashboard = function() {
    return {
        init: function() {
            this.initChart();
        },

        initChart: function() {
            var e = {
                self: null,
                rendered: false
            };

            var r = [54, 42, 75, 90, 23, 87, 50];
            var o = document.querySelector("#kt_charts_widget_32_chart_1");
            if (o) {
                var i = parseInt(KTUtil.css(o, "height")),
                    s = KTUtil.getCssVariableValue("--kt-gray-900"),
                    n = KTUtil.getCssVariableValue("--kt-border-dashed-color"),
                    d = {
                        series: [{
                            name: "Guest",
                            data: r // Menambahkan data ke dalam series
                        }],
                        chart: {
                            fontFamily: "inherit",
                            type: "bar",
                            height: i,
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: ["22%"],
                                borderRadius: 5,
                                dataLabels: {
                                    position: "top"
                                },
                                startingShape: "flat"
                            }
                        },
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -28,
                            style: {
                                fontSize: "13px",
                                colors: [s]
                            }
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"]
                        },
                        xaxis: {
                            categories: ["PSE1", "PSE2", "PSE3", "PSE4", "PSE5", "PSE6", "PSE7"],
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: KTUtil.getCssVariableValue("--kt-gray-500"),
                                    fontSize: "13px"
                                }
                            },
                            crosshairs: {
                                fill: {
                                    gradient: {
                                        opacityFrom: 0,
                                        opacityTo: 0
                                    }
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: KTUtil.getCssVariableValue("--kt-gray-500"),
                                    fontSize: "13px"
                                }
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        states: {
                            normal: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            hover: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            active: {
                                allowMultipleDataPointsSelection: false,
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            }
                        },
                        tooltip: {
                            style: {
                                fontSize: "12px"
                            }
                        },
                        colors: [KTUtil.getCssVariableValue("--kt-primary"), KTUtil.getCssVariableValue("--kt-primary-light")],
                        grid: {
                            borderColor: n,
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        }
                    };
                e.self = new ApexCharts(o, d);
                e.self.render();
                e.rendered = true;

                KTThemeMode.on("kt.thememode.change", function() {
                    if (e.rendered) {
                        e.self.destroy();
                        e.self = new ApexCharts(o, d);
                        e.self.render();
                    }
                });

                var tabTrigger = document.querySelector('[data-bs-toggle="tab"][href="#kt_charts_widget_32"]');
                if (tabTrigger) {
                    tabTrigger.addEventListener("shown.bs.tab", function() {
                        if (!e.rendered) {
                            e.self.render();
                            e.rendered = true;
                        }
                    });
                }
            }
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTChartsDashboard.init();
});
