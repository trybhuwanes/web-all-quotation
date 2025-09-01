"use strict";

var KTFormCreatePIC = (function () {
    const formElement = document.getElementById(
            "kt_account_profile_details_form"
        ),
        submitButton = formElement.querySelector(
            "#kt_account_profile_details_submit"
        );

    const resetErrorMessages = () => {
        // Kosongkan pesan kesalahan di elemen HTML
        $("#nama-error").text("");
        $("#email-error").text("");
        $("#notelpon-error").text("");
        $("#password-error").text("");
    };

    const submitForm = () => {
        var editorElement = document.querySelector(".ql-editor");
        const messageContent = editorElement ? editorElement.innerHTML : "";

        // Reset pesan kesalahan sebelum mengirim form
        resetErrorMessages();

        // Ambil nilai dari form
        const formData = new FormData(formElement);

        // Tampilkan konfirmasi sebelum mengirim
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin data yang dimasukkan sudah benar?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, kirim!",
            cancelButtonText: "Tidak, batalkan",
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim form
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                axios
                    .post(formElement.getAttribute("action"), formData)
                    .then(({ data }) => {
                        if (data.success) {
                            Swal.fire({
                                text: data.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Oke!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    window.location.href = "/admin/dashboard";
                                }
                            });
                        }
                    })
                    .catch(({ response }) => {
                        // Ambil dan tampilkan pesan kesalahan
                        const errors = response.data.errors;

                        if (errors) {
                            $("#nama-error").text(
                                errors.nama ? errors.nama : ""
                            );
                            $("#email-error").text(
                                errors.email ? errors.email : ""
                            );
                            $("#notelpon-error").text(
                                errors.notelpon ? errors.notelpon : ""
                            );
                            $("#password-error").text(
                                errors.password ? errors.password : ""
                            );
                        }

                        Swal.fire({
                            text: "Terjadi kesalahan. Periksa form Anda dan coba lagi.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Oke!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    })
                    .finally(() => {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                    });
            }
        });
    };

    return {
        init: function () {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                submitForm();
            });
        },
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTFormCreatePIC.init();
});
