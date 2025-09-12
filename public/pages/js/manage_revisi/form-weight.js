"use strict";
var KTWeightAdd = (function () {
    const modalElement = document.getElementById("kt_modal_weight"),
        formElement = modalElement.querySelector("#kt_modal_weight_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-weight-modal-action-type="submit"]'
        );

    return {
        init: function () {
            // Initialize submit button
            submitButton.addEventListener("click", (event) => {
                event.preventDefault();
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    KTWeightAdd.submitForm();
                }, 2000);
            });

            // Initialize cancel and close buttons
            KTGlobal().cancelForm(
                '[data-kt-weight-modal-action-type="cancel"], [data-kt-weight-modal-action-type="close"]',
                modalElement,
                () => {
                    KTWeightAdd.clearForm();
                    KTGlobal().resetErrorbags();
                },
                modal
            );

            // Event listener for weight option buttons
            const weightOptionButtons = modalElement.querySelectorAll(
                '[data-kt-modal-weight="option"]'
            );
            weightOptionButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    let weightAmount = this.textContent; // Get the text content (the value) of the button
                    weightAmount = weightAmount.replace(/\./g, ""); // Remove the dots from the value
                    formElement.querySelector(
                        'input[name="weight_amount"]'
                    ).value = weightAmount; // Set the input field value
                });
            });

            // Event listener for volume option buttons
            const volumeOptionButtons = modalElement.querySelectorAll(
                '[data-kt-modal-volume="option"]'
            );
            volumeOptionButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    let volumeAmount = this.textContent; // Get the text content (the value) of the button
                    volumeAmount = volumeAmount.replace(/\./g, ""); // Remove the dots from the value
                    formElement.querySelector(
                        'input[name="volume_amount"]'
                    ).value = volumeAmount; // Set the input field value
                });
            });
        },

        edit: function (data) {
            // Mengisi form dengan data yang akan diedit
            $("#shipping-id").val(data.id);
            $("#weight-p").val(data.weight_p);
            $("#volume-p").val(data.volume_p);

            // Menampilkan modal
            modal.show();
        },

        // Function to clear the form
        clearForm: function () {
            formElement.reset();
            // Reset bid amount input
            formElement.querySelector('input[name="weight_amount"]').value = "";
            $("#shipping-id").val("");
            // modalElement.querySelector("#modal-title").textContent = "Tambah";
        },

        // Function to submit form
        submitForm: function () {
            let url = "";

            const shippingId = $("#shipping-id").val();
            console.log(shippingId)
            
            if (!shippingId) {
                Swal.fire("Error", "Shipping ID tidak ditemukan", "error");
                return;
            }
            const weightP = $("#weight-p").val();
            const volumeP = $("#volume-p").val();

            let formData = new FormData();

            // Check if editing or adding data
            if (shippingId) {
                url = route("shipping.updateWeight", { id: shippingId });
                formData.append("_method", "put");
                formData.append("id", shippingId);
            }

            formData.append("weight_kg", weightP);
            formData.append("volume_m3", volumeP);

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
    KTWeightAdd.init();

    $(document).on("click", ".edit-weight", function () {
        const data = {
            id: $(this).data("kt-shipping-id"),
            weight_p: $(this).data("kt-weight-p"),
            volume_p: $(this).data("kt-volume-p"),
        };
        KTWeightAdd.edit(data);
    });
});


