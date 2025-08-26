"use strict";
var KTAddPic = (function () {
    const t = document.getElementById("kt_modal_add_pic"),
        e = t.querySelector("#kt_modal_determinepic_form"),
        n = new bootstrap.Modal(t),
        i = t.querySelector('[data-kt-addpic-modal-action="submit"]');
    return {
        init: function () {
            (() => {
                i.addEventListener("click", (t) => {
                    t.preventDefault(),
                        (i.setAttribute("data-kt-indicator", "on"),
                        (i.disabled = !0),
                        setTimeout(function () {
                            KTAddPic.submitForm();
                        }, 2e3));
                });
            })();

            KTGlobal().cancelForm(
                '[data-kt-addpic-modal-action="cancel"], [data-kt-addpic-modal-action="close"]',
                t,
                () => {
                    e.reset(), KTGlobal().resetErrorbags();
                },
                n
            );
            this.initPicSelect2();
        },

        initPicSelect2: function () {
            const url = route("select2.item-pic");
            $("#management-pic").select2(this.parentSelect2Options(url));

            let currentPic = $("#current-pic").val();

            if (currentPic) {
                let picData = JSON.parse(currentPic);

                var newOption = new Option(
                    picData.name,
                    picData.id,
                    false,
                    true
                );
                $("#management-pic").append(newOption).trigger("change");
            }
        },
        parentSelect2Options: function (url) {
            const options = {
                ajax: {
                    url: url,
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page,
                        };
                    },
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
                dropdownParent: "#kt_modal_determinepic_form",
            };

            return options;
        },

        submitForm: function () {
            let url = "";
            const oId = $("#poid").val();
            const pic = $("#management-pic").val();
            let formData = new FormData();
            if (oId) {
                url = route("deterimine-pic.update", { id: oId });
                console.log(url);
                formData.append("_method", "put");
                formData.append("id", oId);
            }
            formData.append("picid", pic);

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
    KTAddPic.init();
});
