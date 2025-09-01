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

            let current_product = $("#current-product").val();

            if (current_product) {
                let product = JSON.parse(current_product);

                var newOption = new Option(
                    product.nama_produk,
                    product.id,
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

            let url = "";
            let formData = new FormData();

            const productMain = $("#product-main").val();
            console.log(productMain);
            const productadditionalName = $("#product-additional-name").val();
            const productadditionalDescription = $(
                "#product-additional-description"
            ).val();
            const productadditionalPrice = $("#product-additional-price").val();
            // const productadditionalThumb = $("#file-thumb");
            const additionalproductId = $("#additionalproductid").val();
            // console.log(productadditionalThumb);

            if (additionalproductId) {
                url = route("picproduct-additional.update", {
                    id: additionalproductId,
                });
                formData.append("_method", "put");
                formData.append("id", additionalproductId);
                formData.append("product_id", productMain);
            }

            formData.append("nama_produk_tambahan", productadditionalName);
            formData.append(
                "deskripsi_produk_tambahan",
                productadditionalDescription
            );
            formData.append("harga_produk_tambahan", productadditionalPrice);

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
                                "picproduct-additional.index"
                            );
                            return window.location.href;
                        });
                    }
                })
                .catch(({ response }) => {
                    console.log(response);
                    if (response.data.data.errors) {
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
        },
        resetErrorBags: function () {
            $("#form-error").addClass("d-none");
            $("#error-nik").text("");
            $("#error-name").text("");
            $("#error-identity-card-number").text("");
            $("#error-email").text("");
            $("#error-mobile-phone-number").text("");
        },
        removeDisableAttr: function () {
            $(".form-input, #management-employee-nik").attr("disabled", false);
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTProductsAddProduct.init();
});
