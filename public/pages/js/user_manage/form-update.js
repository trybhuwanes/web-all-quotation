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
        },

        submitForm: function () {
            KTGlobal().resetErrorbags();

            let url = "";
            const userId = $("#user-id").val();
            const name = $("#nama").val();
            // const email = $("#email").val();
            const telpon = $("#notelpon").val();
            const job_title = $("#job_title").val();
            const company = $("#company").val();
            const location_company = $("#location_company").val();
            const field_company = $("#field_company").val();
            const detail_company = $("#detail_company").val();
            let formData = new FormData();

            if (userId) {
                url = route("alluser.update", { id: userId });
                // console.log("ID User Ditemukan");
                formData.append("_method", "put");
                formData.append("id", userId);
            }

            formData.append("name", name);
            formData.append("phone", telpon);
            formData.append("job_title", job_title);
            formData.append("company", company);
            formData.append("location_company", location_company);
            formData.append("field_company", field_company);
            formData.append("detail_company", detail_company);
            // formData.append("location_company", termContent);

            axios
                .post(url, formData)
                .then(({ data }) => {
                    // console.log(data.data.order_id);
                    const code = data.data.order_id;
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
                            let Url = route("alluser.index");
                            window.location.href = Url;
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
        },
        resetErrorBags: function () {
            $("#form-error").addClass("d-none");
            $("#error-nik").text("");
            $("#error-name").text("");
        },
        removeDisableAttr: function () {
            $(".form-input, #management-employee-nik").attr("disabled", false);
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTProductsAddProduct.init();
});
