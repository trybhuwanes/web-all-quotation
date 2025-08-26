"use strict";

var KTModalNewAddress = (function () {
    const modalElement = document.getElementById("kt_modal_new_address"),
        formElement = modalElement.querySelector("#kt_modal_new_address_form"),
        modalInstance = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector("#kt_modal_new_address_submit"),
        cancelButton = modalElement.querySelector('#kt_modal_new_address_cancel'),
        closeButton = modalElement.querySelector('#kt_modal_new_address_close');

    
    new Tagify(document.querySelector('input[name="tgl_hadir"]'), {
        whitelist: ["18 September 2024", "19 September 2024", "20 September 2024"],
        maxTags: 3,
        enforceWhitelist: true,
        dropdown: {
            maxItems: 5,
            enabled: 0,
            closeOnSelect: false
        }
    }).on("change", function () {
        console.log("Changed Date!");
    });

    const submitForm = () => {
        const url = '/presensi';
        let formData = new FormData(formElement);

        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        axios.post(url, formData)
            .then(({ data }) => {
                if (data.success) {
                    Swal.fire({
                        text: "Terima Kasih, Formulir Anda telah berhasil dikirim!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Oke!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            modalInstance.hide();
                            window.location.reload(true);
                        }
                    });
                }
            })
            .catch(({ response }) => {
                console.log(response);
                formElement.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

                if (response.data.errors) {
                    for (const [key, messages] of Object.entries(response.data.errors)) {
                        const feedbackElement = formElement.querySelector(`#${key} + .invalid-feedback`);
                        if (feedbackElement) {
                            feedbackElement.textContent = messages.join(' ');
                        }
                    }
                }
            })
            .finally(() => {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
            });
    };

    return {
        init: function () {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                submitForm();
            });

            cancelButton.addEventListener("click", function (event) {
                event.preventDefault();
                Swal.fire({
                    text: "Are you sure you want to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light",
                    },
                }).then(function (result) {
                    if (result.value) {
                        formElement.reset();
                        modalInstance.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form was not cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            });

            closeButton.addEventListener("click", function (event) {
                event.preventDefault();
                Swal.fire({
                    text: "Are you sure you want to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light",
                    },
                }).then(function (result) {
                    if (result.value) {
                        formElement.reset();
                        modalInstance.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form was not cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            });
        }
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTModalNewAddress.init();
});
