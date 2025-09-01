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
            let formData = new FormData();
            const termId = $("#termid").val();

            var termEditor = document.querySelector(
                "#kt_create_form_editor .ql-editor"
            );
            const termContent = termEditor ? termEditor.innerHTML : "";

            if (termId) {
                url = route("term-payment.update", { id: termId });
                formData.append("_method", "put");
                formData.append("id", termId);
            }
            formData.append("payment_description", termContent);

            axios
                .post(url, formData)
                .then(({ data }) => {
                    console.log(data.data.order_id);
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
                            let Url = route("order-admin.show", { id: code });
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
