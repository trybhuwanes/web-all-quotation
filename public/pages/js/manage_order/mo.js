"use strict";
var KTUsersAddUser = (function () {
    const t = document.getElementById("kt_modal_add_user"),
        e = t.querySelector("#kt_modal_add_user_form"),
        n = new bootstrap.Modal(t),
        i = t.querySelector('[data-kt-users-modal-action="submit"]');
    return {
        init: function () {
            (() => {
                i.addEventListener("click", (t) => {
                    t.preventDefault(),
                        (i.setAttribute("data-kt-indicator", "on"),
                        (i.disabled = !0),
                        setTimeout(function () {
                            KTUsersAddUser.submitForm();
                        }, 2e3));
                });
            })();

            KTGlobal().cancelForm(
                '[data-kt-users-modal-action="cancel"], [data-kt-users-modal-action="close"]',
                t,
                () => {
                    e.reset(), KTGlobal().resetErrorbags();
                },
                n
            );

            // Jika Anda telah menghapus initLocationSelect2, pastikan tidak ada sisa kode di sini
            // this.initLocationSelect2();
        }, // <-- pastikan kurung tutup di sini benar

        // Jika initLocationSelect2 dihapus, pastikan tidak ada kurung tutup yang tersisa dari fungsi ini
        /*
        initLocationSelect2: function () {
            const url = route("master.locations.select2");
            $("#management-employee-location").select2(
                this.parentSelect2Options(url, function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        filters: ["location"],
                    };
                })
            ).on('select:clearing', function (e) {
                $("#management-employee-location").val([]).trigger("change");
            });
        },
        */

        parentSelect2Options: function (url, params = null) {
            if (typeof params != "function") {
                params = function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                    };
                };
            }

            const options = {
                ajax: {
                    url: url,
                    dataType: "json",
                    delay: 250,
                    data: params,
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: params.page * 10 < data.total_count,
                            },
                        };
                    },
                    cache: true,
                },
                dropdownParent: "#kt_modal_add_user",
            };

            return options;
        }, //

        submitForm: function () {
            // *Insert Or Update*
            // *INSERT*
            let url = route("equipment.order.index");
            const soId = $("#soid").val();
            const co = $("input[name='so']:checked").val();

            let formData = new FormData();
            // *UPDATE*
            if (soId) {
                url = route("order-admin.update", { id: soId });
                formData.append("_method", "put");
                formData.append("id", soId);
                formData.append("status", co);
            }

            axios
                .post(url, formData)
                .then(({ data }) => {
                    if (data.success) {
                        Swal.fire({
                            text: `Data berhasil disimpan`,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, lanjutkan!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        }).then(function (t) {
                            t.isConfirmed && n.hide();
                            return window.location.reload(true);
                        });
                    }
                })
                .catch(({ response }) => {
                    console.log(response);
                    $("#form-error").removeClass("d-none");
                    $("#form-error-message").text(response.data.message);
                    if (response.data.errors) {
                        $("#error-category-name").text(
                            response.data.errors.nama_kategori
                        );
                        $("#error-category-description").text(
                            response.data.errors.deskripsi
                        );
                        $("#error-logo").text(response.data.errors.avatar);
                    }
                })
                .finally(() => {
                    i.removeAttribute("data-kt-indicator"), (i.disabled = !1);
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
