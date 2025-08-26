"use strict";
var KTDicountAdd = (function () {
    const modalElement = document.getElementById("kt_modal_discount"),
        formElement = modalElement.querySelector("#kt_modal_discount_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-discount-modal-action-type="submit"]'
        );

    return {
        init: function () {
            // Initialize submit button
            submitButton.addEventListener("click", (event) => {
                event.preventDefault();
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    KTDicountAdd.submitForm();
                }, 2000);
            });

            // Initialize cancel and close buttons
            KTGlobal().cancelForm(
                '[data-kt-discount-modal-action-type="cancel"], [data-kt-discount-modal-action-type="close"]',
                modalElement,
                () => {
                    KTDicountAdd.clearForm();
                    KTGlobal().resetErrorbags();
                },
                modal
            );

            // Event listener for bid option buttons
            const discOptionButtons = modalElement.querySelectorAll(
                '[data-kt-modal-discount="option"]'
            );
            discOptionButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    let discAmount = this.textContent;
                    discAmount = discAmount.replace(/\./g, "");
                    formElement.querySelector(
                        'input[name="discount_amount"]'
                    ).value = discAmount;
                });
            });
        },

        edit: function (data) {
            // Mengisi form dengan data yang akan diedit
            $("#o-id").val(data.id);
            $("#discount").val(data.discount_p);

            // Menampilkan modal
            modal.show();
        },

        // Function to clear the form
        clearForm: function () {
            formElement.reset();
            // Reset bid amount input
            formElement.querySelector('input[name="discount_amount"]').value =
                "";
            $("#o-id").val("");
        },

        // Function to submit form
        submitForm: function () {
            let url = "";
            const oId = $("#o-id").val();
            const discountP = $("#discount").val();

            let formData = new FormData();

            // Check if editing or adding dataw
            if (oId) {
                url = route("give-discounts.update", { id: oId });
                formData.append("_method", "put");
                formData.append("id", oId);
            }
            formData.append("discount_amount", discountP);

            // Send data using axios
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
                        }).then((result) => {
                            if (result.isConfirmed) {
                                modal.hide();
                                window.location.reload(true);
                            }
                        });
                    }
                })
                .catch(({ response }) => {
                    // Handle errors
                    $("#form-error").removeClass("d-none");
                    $("#form-error-message").text(response.data.message);
                    if (response.data.errors) {
                        $("#error-category-name").text(
                            response.data.errors.nama_kategori || ""
                        );
                        $("#error-category-description").text(
                            response.data.errors.deskripsi || ""
                        );
                        $("#error-logo").text(
                            response.data.errors.avatar || ""
                        );
                    }
                })
                .finally(() => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                });
        },
    };
})();

// Initialize after DOM is ready
KTUtil.onDOMContentLoaded(function () {
    KTDicountAdd.init();

    // Event handler for edit button
    $("#kt_ecommerce_sales_order_summary").on(
        "click",
        ".edit-discount",
        function () {
            console.log("diskon");
            const data = {
                id: $(this).attr("data-kt-o-id"),
                discount_p: $(this).attr("data-kt-discount-p"),
            };
            KTDicountAdd.edit(data);
        }
    );
});
