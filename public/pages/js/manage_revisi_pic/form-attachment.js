"use strict";
var KTFileUploadAttach = (function () {
    const modalElement = document.getElementById("kt_modal_attachment"),
        formElement = modalElement.querySelector("#kt_modal_attachment_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-attachment-modal-action-type="submit"]'
        );

    let dropzoneInstance = null;

    return {
        init: function () {
            // Inisialisasi tombol submit
            submitButton.addEventListener("click", (event) => {
                event.preventDefault();
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    KTFileUploadAttach.submitForm();
                }, 2000);
            });

            // Inisialisasi tombol cancel dan close
            KTGlobal().cancelForm(
                '[data-kt-attachment-modal-action-type="cancel"], [data-kt-attachment-modal-action-type="close"]',
                modalElement,
                () => {
                    KTFileUploadAttach.clearForm();
                    KTGlobal().resetErrorbags();
                },
                modal
            );

            // Konfigurasi Dropzone hanya jika belum diinisialisasi
            if (!dropzoneInstance) {
                Dropzone.autoDiscover = false;
                dropzoneInstance = new Dropzone("#kt_modal_attachment_files_upload", {
                    url: route("storage-attachment-dropzone-pdfs"), // Ganti dengan URL upload yang sesuai
                    paramName: "file",
                    maxFiles: 1, // Batasan maksimal hanya 1 file
                    maxFilesize: 5, // Maksimal ukuran file dalam MB
                    addRemoveLinks: true,
                    acceptedFiles: ".pdf", // Hanya menerima file .pdf
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dictDefaultMessage: "Drag or click to upload a PDF file",
                    init: function () {
                        this.on("maxfilesexceeded", function (file) {
                            this.removeAllFiles(); // Menghapus file yang ada jika file baru diunggah
                            this.addFile(file); // Menambahkan file baru
                            Swal.fire({
                                text: "Hanya diperbolehkan mengunggah 1 file PDF.",
                                icon: "warning",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn btn-warning",
                                },
                            });
                        });
                    },
                });
            }
        },

        edit: function (data) {
            // Mengisi form dengan data yang akan diedit
            console.log(data.id);
            $("#attachment-id").val(data.id);
            
            // $("#discount").val(data.discount_p);

            // Menampilkan modal
            modal.show();
        },

        // Function untuk menghapus isi form
        clearForm: function () {
            formElement.reset();
            if (dropzoneInstance) {
                dropzoneInstance.removeAllFiles(true);
            }
        },

        // Function untuk mengirim form
        submitForm: function () {
            let url = "";
            const attachmentId = $("#attachment-id").val();

            console.log('test');
            console.log(attachmentId);

            let formData = new FormData();
            // Tentukan URL dan method berdasarkan kondisi
            if (attachmentId) {
                url = route("orders-attachment", { id: attachmentId });
                formData.append("_method", "put");
                formData.append("id", attachmentId);
            } else {
                url = route("orders-attachment"); // Route untuk create jika belum ada attachmentId
            }

            // Tambahkan file dari Dropzone ke FormData jika ada
            if (dropzoneInstance && dropzoneInstance.files.length > 0) {
                const file = dropzoneInstance.files[0]; // Ambil hanya file pertama
                formData.append("file", file);
            } else {
                Swal.fire({
                    text: "Please upload a PDF file.",
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-warning",
                    },
                });
                return; // Exit function jika file belum diunggah
            }

            axios
                .post(url, formData)
                .then(({ data }) => {
                    if (data.success) {
                        Swal.fire({
                            text: "File berhasil diunggah.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        }).then(() => {
                            modal.hide();
                            window.location.reload();
                        });
                    }
                })
                .catch(({ response }) => {
                    $("#form-error").removeClass("d-none");
                    $("#form-error-message").text(response.data.message);
                })
                .finally(() => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                });
        },
    };
})();

// Initialize setelah DOM siap
KTUtil.onDOMContentLoaded(function () {
    KTFileUploadAttach.init();

    // Event handler for edit button
    $("#kt_modal_attachment_order").on("click", ".attachment", function () {
        const data = {
            id: $(this).attr("data-kt-attachment-id"),
            // delivery_p: $(this).attr("data-kt-shipping-p"),
        };
        console.log(data);
        KTFileUploadAttach.edit(data);
    });

    
});

// Event handler untuk delete attachment
$(document).on("click", "#delete-attachment-btn", function () {
    let orderId = $(this).data("order-id");

    Swal.fire({
        text: "Yakin ingin menghapus file attachment ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
        buttonsStyling: false,
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-secondary"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(route("orders-attachment.destroy", { id: orderId }))
                .then(({ data }) => {
                    if (data.success) {
                        Swal.fire({
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK",
                            buttonsStyling: false,
                            customClass: { confirmButton: "btn btn-primary" }
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                })
                .catch(({ response }) => {
                    Swal.fire({
                        text: response?.data?.message || "Terjadi kesalahan.",
                        icon: "error",
                        confirmButtonText: "OK",
                        buttonsStyling: false,
                        customClass: { confirmButton: "btn btn-danger" }
                    });
                });
        }
    });
});
