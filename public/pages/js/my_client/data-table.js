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
                        text: translate("common.confirm_delete_selected_items"),
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: translate("common.yes_delete"),
                        cancelButtonText: translate("common.no_cancel"),
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
                                              text: translate(
                                                  "common.item_has_deleted"
                                              ),
                                              icon: "success",
                                              buttonsStyling: !1,
                                              confirmButtonText: translate(
                                                  "common.btn_ok_got_it"
                                              ),
                                              customClass: {
                                                  confirmButton:
                                                      "btn fw-bold btn-primary",
                                              },
                                          }).then(function (t) {
                                              return window.location.reload(true);
                                          });
                                      }
                                  })
                            : "cancel" === t.dismiss &&
                              Swal.fire({
                                  text: translate(
                                      "common.selected_item_not_deleted"
                                  ),
                                  icon: "error",
                                  buttonsStyling: !1,
                                  confirmButtonText: translate(
                                      "common.btn_ok_got_it"
                                  ),
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
                document.querySelector('[data-kt-user-table-filter="search"]')
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
            const url = route('client.index', params);
            window.location.href = url;
        },
        edit: function (data) {
            modal.find("#modal-title").text(
                translate("common.btn_edit_x", {
                    x: translate("fields.bank"),
                })
            );
            modal.find("#mb-id").val(data.id);
            modal.find("#mb-nama").val(data.nama);

            modal.modal("show");
        },
        clearForm: function () {
            modal.find("#modal-title").text(
                translate("common.btn_add_x", {
                    x: translate("fields.bank"),
                })
            );
            modal.find("#mb-id").val("");
            modal.find("#mb-nama").val("");
        },
        delete: function (data) {
            const id = data.id;
            const name = data.nama;
            const url = route("master.bank.destroy", {
                bank: id,
            });
            Swal.fire({
                text: translate("common.delete_item_x", {
                    x: name,
                }),
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: translate("common.yes_delete"),
                cancelButtonText: translate("common.no_cancel"),
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                t.value
                    ? axios.delete(url).then(({ data }) => {
                          if (data.success) {
                              Swal.fire({
                                  text: translate("common.item_x_has_deleted", {
                                      x: name,
                                  }),
                                  icon: "success",
                                  buttonsStyling: !1,
                                  confirmButtonText: translate(
                                      "common.btn_ok_got_it"
                                  ),
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
                          text: translate("common.x_not_deleted", {
                              x: name,
                          }),
                          icon: "error",
                          buttonsStyling: !1,
                          confirmButtonText: translate("common.btn_ok_got_it"),
                          customClass: {
                              confirmButton: "btn fw-bold btn-primary",
                          },
                      });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();

    $("#kt_table_users tbody").on("click", ".edit", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama: $(this).attr("data-kt-user-name"),
        };
        KTUsersList.edit(data);
    });

    $("#kt_table_users tbody").on("click", ".delete", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama: $(this).attr("data-kt-user-name"),
        };
        KTUsersList.delete(data);
    });

    $("#kt_modal_add_user").on("hidden.bs.modal", function () {
        KTGlobal().resetErrorbags();
        KTUsersList.clearForm();
    });
});
