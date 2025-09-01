"use strict";
var KTProductsAddProduct = (function () {
    const t = document.getElementById("kt_form_create_product"),
        e = t.querySelector("#kt_create_product_form"),
        i = t.querySelector('[data-kt-product-action="submit"]');
    return {
        init: function () {
            (() => {
                i.addEventListener("click", () => {
                    i.setAttribute("data-kt-indicator", "on"),
                        (i.disabled = !0),
                        setTimeout(function () {
                            KTProductsAddProduct.submitForm();
                        }, 2e3);
                });
                Dropzone.autoDiscover = false;
                new Dropzone("#kt_modal_create_product_galery", {
                    url: route("storage-dropzone-img"),
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
            this.initKategoriProductSelect2();
        },

        initKategoriProductSelect2: function () {
            const url = route("select2.item-category");
            $("#product-category").select2(this.parentSelect2Options(url));

            let current_category = $("#current-category").val();

            if (current_category) {
                let category = JSON.parse(kategori_barang);

                var newOption = new Option(
                    category.nama_kategori,
                    category.id,
                    false,
                    true
                );
                $("#product-category").append(newOption).trigger("change");
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
                dropdownParent: "#kt_create_product_form",
            };

            return options;
        },
        submitForm: function () {
            KTGlobal().resetErrorbags();

            let url = route("product.store");

            const productCategory = $("#product-category").val();
            const productName = $("#product-name").val();
            const productDescription = $("#product-description").val();
            const productThumb = $("#file-thumb");
            var spesifikasiEditor = document.querySelector(
                "#spesifikasi_editor .ql-editor"
            );
            const spesifikasiContent = spesifikasiEditor
                ? spesifikasiEditor.innerHTML
                : "";
            var ringkasanEditor = document.querySelector(
                "#ringkasan_editor .ql-editor"
            );
            const ringkasanContent = ringkasanEditor
                ? ringkasanEditor.innerHTML
                : "";

            let formData = new FormData();
            formData.append("nama_produk", productName);
            formData.append("deskripsi_produk", productDescription);
            formData.append("category_id", productCategory);
            formData.append("ringkasan_deskripsi", ringkasanContent);
            formData.append("spesifikasi_deskripsi", spesifikasiContent);
            let acceptedFiles = $(
                "#kt_modal_create_product_galery"
            )[0].dropzone.getAcceptedFiles();

            for (let i = 0; i < acceptedFiles.length; i++) {
                let file = acceptedFiles[i];
                formData.append("files[]", file);
            }
            if (productThumb.get(0).files.length !== 0) {
                formData.append("thumbnail", productThumb[0].files[0]);
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
                            window.location.href = route("product.index");
                            return window.location.href;
                        });
                    }
                })
                .catch(({ response }) => {
                    console.log(response);
                    if (response.data.errors) {
                        $("#error-product-name").text(
                            response.data.errors.nama_produk[0]
                        );
                        $("#error-product-description").text(
                            response.data.errors.deskripsi_produk
                        );
                        $("#error-product-category").text(
                            response.data.errors.category_id
                        );
                        $("#error-file-thumb").text(
                            response.data.errors.thumbnail
                        );
                        $("#error-upload-photo").text(
                            response.data.errors.files
                        );
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
    KTProductsAddProduct.init();
});
