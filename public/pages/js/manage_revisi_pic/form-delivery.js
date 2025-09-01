"use strict";
var KTDeliveryAdd = (function () {
    const modalElement = document.getElementById("kt_modal_bidding"),
        formElement = modalElement.querySelector("#kt_modal_bidding_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-delivery-modal-action-type="submit"]'
        );

    return {
        init: function () {
            // Initialize submit button
            submitButton.addEventListener("click", (event) => {
                event.preventDefault();
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    KTDeliveryAdd.submitForm();
                }, 2000);
            });

            // Initialize cancel and close buttons
            KTGlobal().cancelForm(
                '[data-kt-delivery-modal-action-type="cancel"], [data-kt-delivery-modal-action-type="close"]',
                modalElement,
                () => {
                    KTDeliveryAdd.clearForm();
                    KTGlobal().resetErrorbags();
                },
                modal
            );

            // Event listener for bid option buttons
            const bidOptionButtons = modalElement.querySelectorAll(
                '[data-kt-modal-bidding="option"]'
            );
            bidOptionButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    let bidAmount = this.textContent; // Get the text content (the value) of the button
                    bidAmount = bidAmount.replace(/\./g, ""); // Remove the dots from the value
                    formElement.querySelector(
                        'input[name="bid_amount"]'
                    ).value = bidAmount; // Set the input field value
                });
            });
        },

        edit: function (data) {
            // Mengisi form dengan data yang akan diedit
            $("#delivery-id").val(data.id);
            $("#delivery-p").val(data.delivery_p);

            // Menampilkan modal
            modal.show();
        },

        // Function to clear the form
        clearForm: function () {
            formElement.reset();
            // Reset bid amount input
            formElement.querySelector('input[name="bid_amount"]').value = "";
            $("#delivery-id").val("");
            // modalElement.querySelector("#modal-title").textContent = "Tambah";
        },

        // Function to submit form
        submitForm: function () {
            let url = route("shippings.store");

            const deliveryId = $("#delivery-id").val();
            const oId = $("#o-id").val();
            const deliverP = $("#delivery-p").val();

            let formData = new FormData();

            // Check if editing or adding data
            if (deliveryId) {
                url = route("shippings.update", { id: deliveryId });
                formData.append("_method", "put");
                formData.append("id", deliveryId);
            }
            formData.append("order_id", oId);
            formData.append("shipping_cost", deliverP);

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
    KTDeliveryAdd.init();

    // Event handler for edit button
    $("#kt_modal_delivery").on("click", ".edit-delivery", function () {
        const data = {
            id: $(this).attr("data-kt-shipping-id"),
            delivery_p: $(this).attr("data-kt-shipping-p"),
        };
        KTDeliveryAdd.edit(data);
    });
});
