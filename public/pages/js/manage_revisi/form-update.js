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
            const url = route("select2.item-category");
            $("#product-category").select2(this.parentSelect2Options(url));

            let current_category = $("#current-category").val();

            if (current_category) {
                let category = JSON.parse(current_category);

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

            let url = "";
            let formData = new FormData();
            const productId = $("#productid").val();
            var spesifikasiEditor = document.querySelector(
                "#spesifikasi_editor .ql-editor"
            );
            const spesifikasiContent = spesifikasiEditor
                ? spesifikasiEditor.innerHTML
                : "";

            console.log(productThumb);

            if (productId) {
                url = route("product.update", { id: productId });
                formData.append("_method", "put");
                formData.append("id", productId);
            }
            formData.append("spesifikasi_deskripsi", spesifikasiContent);

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
                    if (response.data.data.errors) {
                        $("#error-product-category").text(
                            response.data.data.errors.client_id
                        );
                        $("#error-topic").text(response.data.data.errors.topic);
                        $("#error-urgensi").text(
                            response.data.data.errors.urgency
                        );
                        $("#error-subyek").text(
                            response.data.data.errors.subject
                        );
                        $("#error-description").text(
                            response.data.data.errors.description
                        );
                        $("#error-upload-photo").text(
                            response.data.data.errors.files_count
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
