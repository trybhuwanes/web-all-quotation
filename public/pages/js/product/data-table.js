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
            const url = route("product.index", params);
            window.location.href = url;
        },
        edit: function (data) {
            // modal.find("#modal-title").text(
            //     'Ubah Kategori Product'
            // );
            // console.log(data.logo);
            // modal.find("#category-id").val(data.id);
            // modal.find("#category-description").val(data.deskripsi);
            // if (data.logo) {
            //     modal.find("#category-avatar").css("background-image", "url(" + data.logo + ")");
            // }

            console.log(data.thumbnail);
            document.querySelector("#product-name").val(data.nama_product);
            if (data.thumbnail) {
                // Menambahkan gambar ke elemen .image-input-wrapper
                document
                    .querySelector("change-file-thumb")
                    .css("background-image", "url(" + data.thumbnail + ")");
            }
            document.querySelector("#kt_form_create_product").scrollIntoView();
            // modal.modal("show");
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
                text: `Menghapus item ${nama_kategori}.`,
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
                                  text: `Tidak menghapus item ${nama_kategori}.`,
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

    $("#kt_ecommerce_add_product_type card-toolbar a").on(
        "click",
        ".new",
        function () {
            const data = {
                id: $(this).attr("data-kt-user-id"),
                // nama_product: $(this).attr("data-kt-user-name"),
                // deskripsi:s $(this).attr("data-kt-user-deskripsi"),
                // thumbnail: $(this).attr("data-kt-user-thumbnail"),
            };
            console.log(data);
            KTUsersList.edit(data);
        }
    );

    $("#kt_table_users tbody").on("click", ".edit", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama_product: $(this).attr("data-kt-user-name"),
            // deskripsi:s $(this).attr("data-kt-user-deskripsi"),
            thumbnail: $(this).attr("data-kt-user-thumbnail"),
        };
        console.log(data);
        KTUsersList.edit(data);
    });

    $("#kt_table_users tbody").on("click", ".delete", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama_kategori: $(this).attr("data-kt-user-name"),
        };
        console.log(data);
        KTUsersList.delete(data);
    });

    $("#kt_modal_add_user").on("hidden.bs.modal", function () {
        KTGlobal().resetErrorbags();
        KTUsersList.clearForm();
    });

    $('[data-kt-ecommerce-export="excel"]').on("click", function () {
        KTUsersList.exportExcel();
    });
});
