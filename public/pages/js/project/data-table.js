"use strict";
var KTUsersList = (function () {
    var e,
        t,
        n,
        r,
        o = document.getElementById("kt_table_users"),
        l = () => {
            const c = o.querySelectorAll('[type="checkbox"]');
            (t = document.querySelector('[data-kt-user-table-toolbar="base"]')),
                (n = document.querySelector(
                    '[data-kt-user-table-toolbar="selected"]'
                )),
                (r = document.querySelector(
                    '[data-kt-user-table-select="selected_count"]'
                ));
            c.forEach((e) => {
                e.addEventListener("click", function () {
                    setTimeout(function () {
                        a();
                    }, 50);
                });
            });
        };
    return {
        init: function () {
            o &&
                ((e = $(o).DataTable({
                    info: !1,
                    order: [],
                    paging: false,
                    lengthChange: !1,
                    scrollY: "200px", // 👈 ini pengganti div custom
                    scrollCollapse: true,
                    columnDefs: [
                        {
                            orderable: !1,
                            targets: 0,
                        },
                    ],
                })).on("draw", function () {
                    l(), a();
                }),
                l(),
                document
                    .querySelector('[data-kt-user-table-filter="search"]')
                    .addEventListener("keypress", function (t) {
                        if (t.key === "Enter") {
                            KTUsersList.search(t.target.value);
                        }
                    }));
        },
        search: function (q) {
            console.log(`searching for ${q}...`);
            const currentParams = route().params;
            delete currentParams.q;
            delete currentParams.page;
            const params = {
                q,
                ...currentParams,
            };
            const url = route("projects.index", params);
            window.location.href = url;
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});
