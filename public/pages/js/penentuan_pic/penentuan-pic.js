"use strict";

var KTFormEditPresensi = (function () {
    const formElement = document.getElementById("kt_account_profile_details_form"),
        submitButton = document.getElementById("kt_account_profile_details_submit"),
        cancelButton = formElement.querySelector("button[type='reset']");

    const submitForm = () => {
        // Ambil nilai dari input
        const picId = formElement.querySelector('select[name="pic"]').value;
        const editedId = formElement.querySelector('input[name="id"]').value; // Pastikan ada input hidden untuk ID yang diedit

        if (!picId) {
            Swal.fire({
                text: "Anda harus memilih PIC sebelum menyimpan!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
            return; // Hentikan eksekusi jika PIC tidak dipilih
        }

        // // Tampilkan nilai di konsol untuk verifikasi
        // console.log("PIC ID:", picId);
        // console.log("Edited ID:", editedId);

        // Kirim data ke server jika perlu
        const url = '/admin/pic'; 
        let formData = new FormData();
        formData.append('pic', picId);
        formData.append('id', editedId);

        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        axios.post(url, formData)
            .then(({ data }) => {
                if (data.success) {
                    Swal.fire({
                        text: "Data berhasil disimpan!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Oke!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            window.location.href = '/admin/presensi';
                            // window.location.reload(true);
                        }
                    });
                }
            })
            .catch(({ response }) => {
                console.log(response);
                // Tangani kesalahan
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
                    text: "Anda yakin ingin membatalkan?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Ya, batalkan!",
                    cancelButtonText: "Tidak, kembali",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light",
                    },
                }).then(function (result) {
                    if (result.value) {
                        formElement.reset();
                        // window.location.reload(true);
                        window.location.href = '/admin/presensi';
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Formulir Anda tidak dibatalkan!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK, mengerti!",
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
    KTFormEditPresensi.init();
});
