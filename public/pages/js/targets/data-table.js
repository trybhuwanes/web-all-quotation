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
            const s = document.querySelector(
                '[data-kt-user-table-select="delete_selected"]'
            );
            c.forEach((e) => {
                e.addEventListener("click", function () {
                    setTimeout(function () {
                        a();
                    }, 50);
                });
            }),
                s.addEventListener("click", function () {
                    Swal.fire({
                        text: `Apakah Anda yakin ingin menghapus item yang dipilih?`,
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Batal",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton:
                                "btn fw-bold btn-active-light-primary",
                        },
                    }).then(function (t) {
                        const url = route("master.bank.destroyMultiple");
                        const itemSelected = $(".check-user:checked")
                            .map(function (idx, elem) {
                                return $(elem).val();
                            })
                            .get();
                        t.value
                            ? axios
                                  .post(url, { id: itemSelected })
                                  .then(({ data }) => {
                                      if (data.success) {
                                          Swal.fire({
                                              text: `Menghapus semua item yang dipilih`,
                                              icon: "success",
                                              buttonsStyling: !1,
                                              confirmButtonText:
                                                  "Ok, lanjutkan!",
                                              customClass: {
                                                  confirmButton:
                                                      "btn fw-bold btn-primary",
                                              },
                                          }).then(function (t) {
                                              return window.location.reload(
                                                  true
                                              );
                                          });
                                      }
                                  })
                            : "cancel" === t.dismiss &&
                              Swal.fire({
                                  text: `Item yang dipilih tidak dihapus`,
                                  icon: "error",
                                  buttonsStyling: !1,
                                  confirmButtonText: "Ok, lanjutkan!",
                                  customClass: {
                                      confirmButton: "btn fw-bold btn-primary",
                                  },
                              });
                    });
                });
        };
    const a = () => {
        const e = o.querySelectorAll('tbody [type="checkbox"]');
        let c = !1,
            l = 0;
        e.forEach((e) => {
            e.checked && ((c = !0), l++);
        }),
            c
                ? ((r.innerHTML = l),
                  t.classList.add("d-none"),
                  n.classList.remove("d-none"))
                : (t.classList.remove("d-none"), n.classList.add("d-none"));
    };
    const modal = $("#kt_modal_add_user");
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
            const url = route("targets.index", params);
            window.location.href = url;
        },
        edit: function (data) {
            modal.find("#modal-title").text("Ubah Data");
            console.log(data.id);
            modal.find("#target-id").val(data.id);
            modal.find("#target-month").val(data.target_month);
            modal.find("#target-amount").val(data.target_amount);
            modal.find("#target-year").val(data.target_year);
            modal.modal("show");
        },
        clearForm: function () {
            modal.find("#modal-title").text("Target Baru");
            modal.find("#target-id").val("");
            modal.find("#target-month").val("");
            modal.find("#target-amount").val("");
            modal.find("#target-year").val("");

            // Ambil last target dari hidden input
            let lastMonth = parseInt($("#last-target-month").val());
            let lastYear = parseInt($("#last-target-year").val());

            if (!isNaN(lastMonth) && !isNaN(lastYear)) {
                // Kalau target terakhir bulan Desember → mulai Januari tahun berikutnya
                if (lastMonth === 12) {
                    modal.find("#target-month").val(1); // Januari
                    modal.find("#target-year").val(lastYear + 1);
                } else {
                    modal.find("#target-month").val(lastMonth + 1);
                    modal.find("#target-year").val(lastYear);
                }
            } else {
                // Kalau user belum punya target → default bulan & tahun sekarang
                let today = new Date();
                modal.find("#target-month").val(today.getMonth() + 1);
                modal.find("#target-year").val(today.getFullYear());
            }
        },
        delete: function (data) {
            const id = data.id;
            const nama_kategori = data.nama_kategori;
            const url = route("kategori-product.destroy", { id: id });
            Swal.fire({
                text: `Anda akan menghapus item ${nama_kategori}.`,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                t.value
                    ? axios.delete(url).then(({ data }) => {
                          if (data.success) {
                              Swal.fire({
                                  text: `Anda akan menghapus item ${nama_kategori}.`,
                                  icon: "success",
                                  buttonsStyling: !1,
                                  confirmButtonText: "Ok, lanjutkan!",
                                  customClass: {
                                      confirmButton: "btn fw-bold btn-primary",
                                  },
                              }).then(function (t) {
                                  return window.location.reload(true);
                              });
                          }
                      })
                    : "cancel" === t.dismiss &&
                      Swal.fire({
                          text: `Tidak menghapus item ${nama_kategori}.`,
                          icon: "error",
                          buttonsStyling: !1,
                          confirmButtonText: "Ok, lanjutkan!",
                          customClass: {
                              confirmButton: "btn fw-bold btn-primary",
                          },
                      });
            });
        },

        detail: function (data) {
            const modal = $("#kt_modal_show_user");
            modal.find("#modal-title").text("Detail Kategori Product");
            console.log(data.logo);
            // modal.find("#category-id").text(data.id);
            modal.find("#category-name").text(data.nama_kategori);
            modal.find("#category-description").text(data.deskripsi);
            if (data.logo) {
                modal
                    .find("#category-avatar")
                    .css("background-image", "url(" + data.logo + ")");
            }

            modal.modal("show");
        },
        exportExcel: function () {
            const currentParams = route().params;
            const params = {
                ...currentParams,
            };
            const url = route(`admin.laporan.export-excel`, params);
            window.location.href = url;
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();

    $("#kt_table_users tbody").on("click", ".edit", function () {
        const data = {
            id: $(this).attr("data-kt-id"),
            target_month: $(this).attr("data-kt-target-month"),
            target_amount: $(this).attr("data-kt-target-amount"),
            target_year: $(this).attr("data-kt-target-year"),
        };
        KTUsersList.edit(data);
    });

    $("#kt_table_users tbody").on("click", ".detail", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama_kategori: $(this).attr("data-kt-user-name"),
            deskripsi: $(this).attr("data-kt-user-deskripsi"),
            logo: $(this).attr("data-kt-user-logo"),
        };
        console.log(data);
        KTUsersList.detail(data);
    });

    $("#kt_modal_add_user").on("hidden.bs.modal", function () {
        KTGlobal().resetErrorbags();
        KTUsersList.clearForm();
    });

    $('[data-kt-ecommerce-export="excel"]').on("click", function () {
        KTUsersList.exportExcel();
    });
});
