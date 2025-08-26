"use strict";
var KTUsersAddUser = (function () {
    const modalElement = document.getElementById("kt_modal_add_user"),
        formElement = modalElement.querySelector("#kt_modal_add_user_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-users-modal-action="submit"]'
        );

    return {
        init: function () {
            // Inisialisasi tombol submit
            submitButton.addEventListener("click", (event) => {
                event.preventDefault();
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    KTUsersAddUser.submitForm();
                }, 2000);
            });

            // Inisialisasi tombol cancel dan close
            KTGlobal().cancelForm(
                '[data-kt-users-modal-action="cancel"], [data-kt-users-modal-action="close"]',
                modalElement,
                () => {
                    KTUsersAddUser.clearForm();
                    KTGlobal().resetErrorbags();
                },
                modal
            );
        },

        // Fungsi untuk mengatur form dalam mode edit
        edit: function (data) {
            // Mengubah judul modal menjadi "Edit"
            modalElement.querySelector("#modal-title").textContent = "Ubah";
            // Mengisi form dengan data yang akan diedit
            $("#category-id").val(data.id);
            $("#category-name").val(data.nama_kategori);
            $("#category-description").val(data.deskripsi);

            // Menampilkan modal
            modal.show();
        },

        // Fungsi untuk membersihkan form
        clearForm: function () {
            formElement.reset();
            $("#category-id").val("");
            modalElement.querySelector("#modal-title").textContent = "Tambah";
        },

        // Fungsi untuk submit form
        submitForm: function () {
            let url = route("revision-document.store");
            const oId = $("#or-id").val();
            const categoryId = $("#category-id").val();
            const numberRev = $("#category-name").val();
            const deskripsiRev = $("#category-description").val();
            let formData = new FormData();

            // Cek apakah sedang mengedit atau menambahkan data
            if (categoryId) {
                url = route("revision-document.update", { id: categoryId });
                formData.append("_method", "put");
                formData.append("id", categoryId);
            }
            formData.append("order_id", oId);
            formData.append("revision_number", numberRev);
            formData.append("revision_description", deskripsiRev);

            // Mengirim data menggunakan axios
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
                    // Menangani error
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

// Inisialisasi setelah DOM siap
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();

    // Event handler untuk tombol edit
    $("#kt_modal_add_user tbody").on("click", ".edit-revisi", function () {
        const data = {
            id: $(this).attr("data-kt-user-id"),
            nama_kategori: $(this).attr("data-kt-user-name"),
            deskripsi: $(this).attr("data-kt-user-deskripsi"),
        };
        KTUsersAddUser.edit(data);
    });
});
