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
            const url = route("kategori-product.index", params);
            window.location.href = url;
        },
        edit: function (data) {
            modal.find("#modal-title").text("Ubah Kategori Product");
            console.log(data.logo);
            modal.find("#category-id").val(data.id);
            modal.find("#category-name").val(data.nama_kategori);
            modal.find("#category-description").val(data.deskripsi);
            if (data.logo) {
                modal
                    .find("#category-avatar")
                    .css("background-image", "url(" + data.logo + ")");
            }

            modal.modal("show");
        },
        clearForm: function () {
            modal.find("#modal-title").text("Ubah Kategori Product");
            modal.find("#category-id").val("");
            modal.find("#category-name").val("");
            modal.find("#category-description").val("");
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
            id: $(this).attr("data-kt-user-id"),
            nama_kategori: $(this).attr("data-kt-user-name"),
            deskripsi: $(this).attr("data-kt-user-deskripsi"),
            logo: $(this).attr("data-kt-user-logo"),
        };
        KTUsersList.edit(data);
    });

    $("#kt_table_users tbody").on("click", ".delete", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama_kategori: $(this).attr("data-kt-user-name"),
        };
        KTUsersList.delete(data);
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
