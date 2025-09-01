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
            })();
            this.initKategoriProductSelect2();
        },
        initKategoriProductSelect2: function () {
            const url = route("select2.item-productmain");
            $("#product-main").select2(this.parentSelect2Options(url));

            let current_category = $("#current-category").val();

            if (current_category) {
                let category = JSON.parse(kategori_barang);

                var newOption = new Option(
                    category.nama_kategori,
                    category.id,
                    false,
                    true
                );
                $("#product-main").append(newOption).trigger("change");
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

            let url = route("product-additional.store");

            const productMain = $("#product-main").val();
            const productadditionalName = $("#product-additional-name").val();
            const productadditionalDescription = $(
                "#product-additional-description"
            ).val();
            const productadditionalPrice = $("#product-additional-price").val();
            const productadditionalThumb = $("#file-thumb");
            console.log(productadditionalThumb);

            let formData = new FormData();
            formData.append("product_id", productMain);
            formData.append("nama_produk_tambahan", productadditionalName);
            formData.append(
                "deskripsi_produk_tambahan",
                productadditionalDescription
            );
            formData.append("harga_produk_tambahan", productadditionalPrice);

            if (productadditionalThumb.get(0).files.length !== 0) {
                formData.append(
                    "thumbnail_produk_tambahan",
                    productadditionalThumb[0].files[0]
                );
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
                            window.location.href = route(
                                "product-additional.index"
                            );
                            return window.location.href;
                        });
                    }
                })
                .catch(({ response }) => {
                    console.log(response);
                    if (response.data.errors) {
                        $("#error-product-additional-name").text(
                            response.data.errors.nama_produk_tambahan[0]
                        );
                        $("#error-product-additional-price").text(
                            response.data.errors.harga_produk_tambahan[0]
                        );
                        $("#error-product-additional-description").text(
                            response.data.errors.deskripsi_produk_tambahan[0]
                        );
                        $("#error-file-thumb").text(
                            response.data.errors.thumbnail
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
            $("#management-employee-identity-card-number").val("");
            $("#management-employee-email").val("");
            $("#management-employee-mobile-phone-number").val("");
            $("#management-employee-password").val("");
            $("#management-employee-address").val("");
            $("#management-employee-date-of-birth").flatpickr().setDate("");
            $("#management-employee-registration-date").flatpickr().setDate("");
            $("#management-employee-location").val("").trigger("change");
            $("#management-employee-active").prop("checked", false);
        },

        resetErrorBags: function () {
            $("#form-error").addClass("d-none");
            $("#error-nik").text("");
            $("#error-name").text("");
            $("#error-identity-card-number").text("");
            $("#error-email").text("");
            $("#error-mobile-phone-number").text("");
            $("#error-password").text("");
            $("#error-address").text("");
            $("#error-date-of-birth").text("");
            $("#error-registration-date").text("");
            $("#error-location").text("");
            $("#error-management-position").text("");
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
