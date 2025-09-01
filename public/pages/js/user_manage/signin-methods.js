"use strict";

var KTAccountSettingsSigninMethods = (function () {
    var t,
        e,
        n,
        o,
        i,
        s,
        r,
        a,
        l,
        axiosEmailURL,
        axiosPasswordURL,
        emailFormValidation,
        passwordFormValidation;

    // Define URLs for each form submission
    axiosEmailURL = "/update-email-url"; // Ganti dengan URL update email Anda
    axiosPasswordURL = "/update-password-url"; // Ganti dengan URL update password Anda

    // Toggle functions
    var d = function () {
        e.classList.toggle("d-none"),
            s.classList.toggle("d-none"),
            n.classList.toggle("d-none");
    };

    var c = function () {
        o.classList.toggle("d-none"),
            a.classList.toggle("d-none"),
            i.classList.toggle("d-none");
    };

    // Axios for updating email with validation check
    var handleUpdateEmail = function () {
        emailFormValidation.validate().then(function (status) {
            if (status === "Valid") {
                let url = "";
                const userId = $("#user-id").val();
                const newEmail = $("#emailaddress").val();
                const currentPassword = $("#confirmemailpassword").val();

                let formData = new FormData();
                if (userId) {
                    url = route("admin.update.mail", { id: userId });
                    formData.append("_method", "put");
                    formData.append("id", userId);
                    formData.append("new_email", newEmail);
                    formData.append("current_password", currentPassword);
                }

                axios
                    .post(url, formData)
                    .then(function (response) {
                        swal.fire({
                            text: "Email updated successfully",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton:
                                    "btn font-weight-bold btn-light-primary",
                            },
                        }).then(function () {
                            t.reset();
                            emailFormValidation.resetForm();
                            d();
                        });
                    })
                    .catch(function (response) {
                        if (response.response.data.message) {
                            $("#emailaddress-error").text(
                                response.response.data.message
                            );
                        }
                    });
            } else {
                swal.fire({
                    text: "Please correct the errors and try again.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary",
                    },
                });
            }
        });
    };

    // Axios for updating password with validation check
    var handleUpdatePassword = function () {
        passwordFormValidation.validate().then(function (status) {
            if (status === "Valid") {
                let url = "";
                // let currentPassword = document.getElementById("currentpassword").value;

                const userId = $("#user-id").val();
                const newPassword = $("#newpassword").val();
                const confirmPassword = $("#confirmpassword").val();

                let formData = new FormData();
                if (userId) {
                    url = route("admin.update.pass", { id: userId });
                    formData.append("_method", "put");
                    formData.append("id", userId);
                    formData.append("new_password", newPassword);
                    formData.append("confirm_password", confirmPassword);
                }
                axios
                    .post(url, formData)
                    .then(function (response) {
                        swal.fire({
                            text: "Password updated successfully",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton:
                                    "btn font-weight-bold btn-light-primary",
                            },
                        }).then(function () {
                            document
                                .getElementById("kt_signin_change_password")
                                .reset();
                            passwordFormValidation.resetForm();
                            c();
                        });
                    })
                    .catch(function (error) {
                        swal.fire({
                            text: "Failed to update password, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton:
                                    "btn font-weight-bold btn-light-primary",
                            },
                        });
                    });
            } else {
                swal.fire({
                    text: "Please correct the errors and try again.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary",
                    },
                });
            }
        });
    };

    return {
        init: function () {
            (t = document.getElementById("kt_signin_change_email")),
                (e = document.getElementById("kt_signin_email")),
                (n = document.getElementById("kt_signin_email_edit")),
                (o = document.getElementById("kt_signin_password")),
                (i = document.getElementById("kt_signin_password_edit")),
                (s = document.getElementById("kt_signin_email_button")),
                (r = document.getElementById("kt_signin_cancel")),
                (a = document.getElementById("kt_signin_password_button")),
                (l = document.getElementById("kt_password_cancel"));

            // Event listeners
            if (s) s.querySelector("button").addEventListener("click", d);
            if (r) r.addEventListener("click", d);
            if (a) a.querySelector("button").addEventListener("click", c);
            if (l) l.addEventListener("click", c);

            // Initialize email form validation
            emailFormValidation = FormValidation.formValidation(t, {
                fields: {
                    emailaddress: {
                        validators: {
                            notEmpty: { message: "Email is required" },
                            emailAddress: {
                                message:
                                    "The value is not a valid email address",
                            },
                        },
                    },
                    confirmemailpassword: {
                        validators: {
                            notEmpty: { message: "Password is required" },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                    }),
                },
            });

            // Email form submission handler
            document
                .getElementById("kt_signin_submit")
                .addEventListener("click", function (e) {
                    e.preventDefault();
                    handleUpdateEmail();
                });

            // Initialize password form validation
            passwordFormValidation = FormValidation.formValidation(
                document.getElementById("kt_signin_change_password"),
                {
                    fields: {
                        // currentpassword: {
                        //     validators: {
                        //         notEmpty: {
                        //             message: "Current Password is required",
                        //         },
                        //     },
                        // },
                        newpassword: {
                            validators: {
                                notEmpty: {
                                    message: "Kata Sandi baru diperlukan",
                                },
                            },
                        },
                        confirmpassword: {
                            validators: {
                                notEmpty: {
                                    message: "Konfirmasi Kata Sandi diperlukan",
                                },
                                identical: {
                                    compare: function () {
                                        return document.getElementById(
                                            "newpassword"
                                        ).value;
                                    },
                                    message:
                                        "Kata sandi dan konfirmasinya tidak sama",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                        }),
                    },
                }
            );

            // Password form submission handler
            document
                .getElementById("kt_password_submit")
                .addEventListener("click", function (e) {
                    e.preventDefault();
                    handleUpdatePassword();
                });
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsSigninMethods.init();
});
