"use strict";
var KTProjectsAddProject = (function () {
    const t = document.getElementById("kt_form_create_project"),
        e = t.querySelector("#kt_create_project_form"),
        i = t.querySelector('[data-kt-project-action="submit"]');
    return {
        init: function () {
            (() => {
                i.addEventListener("click", () => {
                    i.setAttribute("data-kt-indicator", "on"),
                        (i.disabled = !0),
                        setTimeout(function () {
                            KTProjectsAddProject.submitForm();
                        }, 2e3);
                });
                Dropzone.autoDiscover = false;
                new Dropzone("#kt_modal_create_project_galery", {
                    url: route("storage-dropzone-img"),
                    // url: "#", // dummy
                    // autoProcessQueue: false, // ⬅️ ini penting
                    // uploadMultiple: true,
                    paramName: "file",
                    maxFiles: 3,
                    maxFilesize: 2,
                    addRemoveLinks: true,
                    acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
            })();
            this.initKategoriProjectSelect2();
        },

        initKategoriProjectSelect2: function () {
            const url = route("select2.item-productmain");
            $("#product").select2(this.parentSelect2Options(url));

            let current_category = $("#current-category").val();

            if (current_category) {
                let category = JSON.parse(kategori_barang);

                var newOption = new Option(
                    category.nama_kategori,
                    category.id,
                    false,
                    true
                );
                $("#product").append(newOption).trigger("change");
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
                            q: params.term, // search term
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
                dropdownParent: "#kt_create_project_form",
            };

            return options;
        },
        submitForm: function () {
            KTGlobal().resetErrorbags();

            let url = route("projects.store");

            const product = $("#product").val();
            const companyName = $("#company-name").val();
            var deskripsiEditor = document.querySelector(
                "#deskripsi_editor .ql-editor"
            );
            const deskripsiContent = deskripsiEditor
                ? deskripsiEditor.innerHTML
                : "";

            let formData = new FormData();
            formData.append("company_name", companyName);
            formData.append("product_id", product);
            formData.append("description", deskripsiContent);
            let acceptedFiles = $(
                "#kt_modal_create_project_galery"
            )[0].dropzone.getAcceptedFiles();

            for (let i = 0; i < acceptedFiles.length; i++) {
                let file = acceptedFiles[i];
                formData.append("files[]", file);
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
                        }).then(function () {
                            window.location.href = route("projects.index");
                            return window.location.href;
                        });
                    }
                })
                .catch(({ response }) => {
                    console.log(response);
                    if (response.data.errors) {
                        $("#error-project-name").text(response.data.errors.company_name ?? "");
                        $("#error-project-description").text(response.data.errors.description ?? "");
                        $("#error-project-category").text(response.data.errors.product_id ?? "");
                        $("#error-upload-photo").text(response.data.errors.files ?? "");
                    }
                })
                .finally(() => {
                    i.removeAttribute("data-kt-indicator"), (i.disabled = !1);
                });
        },
        clearForm: function () {
            $("#management-employee-is-member").val(0);
            $("#management-employee-name").val("");
            $("#management-employee-email").val("");
            $("#management-employee-mobile-phone-number").val("");
            $("#management-employee-active").prop("checked", false);
        },
        resetErrorBags: function () {
            $("#form-error").addClass("d-none");
            $("#error-nik").text("");
            $("#error-name").text("");
            $("#error-email").text("");
            $("#error-active").text("");
        },
        removeDisableAttr: function () {
            $(".form-input, #management-employee-nik").attr("disabled", false);
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTProjectsAddProject.init();
});
